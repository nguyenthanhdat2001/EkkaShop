<?php
// echo '<pre>';
// print_r($dataUserAd);
// echo '</pre>';
?>
<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Danh sách người dùng</h3>
                    <a href="admin/add-user" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Thêm người dùng</a>
                </div>
            </div>
        </div> <!-- Row end  -->
        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>

                                <tr>
                                    <th>Họ và tên</th>
                                    <th>Ngày tham gia</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th>Thực thi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataUserAd as $key => $dataUserAdItem) {
                                    extract($dataUserAdItem)
                                ?>
                                    <tr>

                                        <td>
                                            <div class="d-flex align-items-center ">
                                                <img style="width: 50px;" class="rounded-2 me-3  object-fit-contain  " src="<?= $avatar ?>" alt="<?= $fullname ?>">
                                                <p class="mb-0 text-truncate " style="max-width: 200px"><?= $fullname ?></p>
                                            </div>

                                        </td>
                                        <td><?= date('Y-m-d', strtotime($create_At)) ?></td>
                                        <td><?= $email ?></td>
                                        <td><?= $phone ?></td>
                                        <td>
                                            <span class="badge <?= $isBlock == 1 ? 'bg-danger' : 'bg-success' ?>"><?= $isBlock == 1 ? 'Chưa công bố' : 'Công bố' ?></span>
                                        </td>

                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="admin/update-user/<?= $id ?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                <button onclick="handleConfirm('admin/user/deleteUser/<?= $id ?>')" type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
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