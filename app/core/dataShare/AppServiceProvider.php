<?php
class AppServiceProvider extends ServiceProvider
{
    function boot()
    {
        //Get dataAccess token
        if (!empty($this->getDataAccessToken())) {
            ViewShare::share('userData', $this->getDataAccessToken());
        }
        if (!empty($this->getDataStoreCustom())) {
            ViewShare::share('dataStoreCustom', $this->getDataStoreCustom());
        }
    }


    private function getDataAccessToken()
    {
        if (!empty(Session::get('userLogin'))) {
            $dataToken = JWT::verifyJWT(Session::get('userLogin'));
            if ($dataToken['valid'] == 1 && !isset($dataToken['error']) && !empty($dataToken['payload']) && $dataToken['payload']['isBlock'] == 0) {
                return $dataToken['payload'];
            }
        }
        return [];
    }

    private function getDataStoreCustom()
    {
        $dataStoreCustom = $this->db->table('store_custom')->getOne();
        if (!empty($dataStoreCustom)) {
            return $dataStoreCustom;
        }
        return [];
    }
}
