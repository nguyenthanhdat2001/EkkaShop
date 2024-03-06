<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Danh sách tin tức</h3>
                    <a href="admin/add-news" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Thêm tin tức</a>
                </div>
            </div>
        </div> <!-- Row end  -->
        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        // echo '<pre>';
                        // print_r($dataNews);
                        // echo '</pre>';
                        ?>
                        <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>

                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Ngày đăng</th>
                                    <th>Người đăng</th>
                                    <th>Lượt xem</th>
                                    <th>Trạng thái</th>
                                    <th>Thực thi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataNews as $key => $dataNewsItem) {
                                    extract($dataNewsItem)
                                ?>
                                    <tr>

                                        <td>
                                            <div class="d-inline-flex align-items-center ">
                                                <img style="width: 50px;" class="rounded-2 me-3  object-fit-contain  " src="<?= $thumb ?>" alt="<?= $title ?>">
                                                <p class="mb-0 text-truncate " style="max-width: 250px"><?= $title ?></p>
                                            </div>

                                        </td>
                                        <td><?= date('Y-m-d', strtotime($create_at)) ?></td>
                                        <td><?= $fullname ?></td>
                                        <td><?= $view ?></td>
                                        <td>
                                            <span class="badge <?= $status == 0 ? 'bg-danger' : 'bg-success' ?>"><?= $status == 0 ? 'Chưa công bố' : 'Công bố' ?></span>
                                        </td>

                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="admin/update-news/<?= $id ?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                <button onclick="handleConfirm('admin/delete-news/<?= $id ?>')" type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>