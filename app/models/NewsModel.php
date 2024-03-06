<?php
class NewsModel extends BaseModel
{


    public function tableName()
    {
        return 'news';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }

    function getAllNews()
    {
        return $this->db->table($this->tableName())->select('user.fullname, news.id, news.slug, news.title, news.content, news.thumb, news.create_at, news.view, news.status')->join('user', 'news.user_id = user.id')->where('news.status', '=', '1')->orderBy('news.create_at')->get();
    }

    function getNewsUser($id)
    {
        $sql = "SELECT user.fullname, user.avatar, news.id, news.title, news.content, news.thumb, news.slug, news.create_at, news.view, news.status FROM news INNER JOIN user ON news.user_id = user.id WHERE news.id = $id ";
        $data = $this->db->query($sql);

        return $data->fetch(PDO::FETCH_ASSOC);
    }

    function getOneNews($id)
    {
        return $this->db->findById($this->tableName(), 'id, title, content, thumb, status', $id);
    }

    function addNewNews($data)
    {
        return $this->db->create($this->tableName(), $data);
    }
    function updateNews($id, $data)
    {
        return $this->db->findByIdAndUpdate($this->tableName(), $id, $data);
    }
    function deleteNews($id)
    {
        return $this->db->findIdAndDelete($this->tableName(), $id);
    }
}
