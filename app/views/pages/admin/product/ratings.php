<?php
// echo '<pre>';
// print_r($dataRatings);
// echo '</pre>';
?>
<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Danh sách đánh giá</h3>
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
                                    <th>Tên danh mục</th>
                                    <th>Ngày đánh giá</th>
                                    <th>Số sao</th>
                                    <th>Nhận xét</th>
                                    <th>Trạng thái</th>
                                    <th>Ẩn đánh giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataRatings as $key => $dataRatingsItem) {
                                    extract($dataRatingsItem)
                                ?>
                                    <tr>

                                        <td>
                                            <div class="d-flex align-items-center ">
                                                <img style="width: 50px;" class="rounded-2 me-3  object-fit-contain  " src="<?= $avatar ?>" alt="<?= $fullname ?>">
                                                <p class="mb-0 text-truncate " style="max-width: 200px"><?= $fullname ?></p>
                                            </div>

                                        </td>
                                        <td><?= date('Y-m-d', strtotime($create_at)) ?></td>
                                        <td><?= Format::renderStars($star) ?></td>
                                        <td><?= $comment ?></td>
                                        <td>
                                            <span class="badge <?= $status == 0 ? 'bg-danger' : 'bg-success' ?>"><?= $status == 0 ? 'Chưa công bố' : 'Công bố' ?></span>
                                        </td>

                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button onclick="" type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
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