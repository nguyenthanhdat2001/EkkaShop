		<!-- Body: Body -->
		<div class="body d-flex py-3">
		    <div class="container-xxl">
		        <form method="post" enctype="multipart/form-data">

		            <div class="row align-items-center">
		                <div class="border-0 mb-4">
		                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
		                        <h3 class="fw-bold mb-0">Thêm sản phẩm</h3>
		                        <button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Lưu</button>
		                    </div>
		                </div>
		            </div> <!-- Row end  -->

		            <div class="row g-3 mb-3">

		                <div class="card mb-3">
		                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
		                        <h6 class="m-0 fw-bold">Thông tin sản phẩm</h6>

		                    </div>
		                    <div class="card-body">
		                        <div class="row g-3 align-items-center">
		                            <div class="col-md-12">
		                                <label class="form-label">Tên sản phẩm </label>
		                                <input type="text" readonly value="<?= $dataProd['title'] ?? '' ?>" class="form-control">
		                            </div>

		                            <div class="col-md-6">
		                                <label class="form-label">Đơn giá </label>
		                                <input type="number" readonly value="<?= $dataProd['price'] ?? '' ?>" class="form-control">
		                            </div>
		                            <div class="col-md-6">
		                                <label class="form-label">Ngày đăng </label>
		                                <input type="text" readonly value="<?= $dataProd['create_at'] ?? '' ?>" class="form-control">
		                            </div>
		                            <!-- <div class="col-md-6">
		                            <label class="form-label">Tên sản phẩm </label>
		                            <input type="number" readonly value="<?= $dataProd['price'] ?? '' ?>" class="form-control">
		                        </div> -->

		                        </div>
		                    </div>
		                </div>

		                <div class="card mb-3">
		                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
		                        <h6 class="mb-0 fw-bold ">Thuộc tính</h6>
		                    </div>
		                    <div class="d-flex ">
		                        <?php
                                foreach ($attributeData as $attributeItem) {
                                ?>
		                            <div class="card-body product-variant">
		                                <label class="form-label w-100"><?= $attributeItem['name'] . ' (' . $attributeItem['display_name'] . ')' ?></label>
		                                <?php foreach ($attributeValueData as $attributeValueItem) {
                                            if ($attributeItem['id'] == $attributeValueItem['attribute_id']) {
                                        ?>
		                                        <div class="form-check">
		                                            <input class="form-check-input" name="attribute_id_<?= $attributeItem['name'] ?>" type="radio" value="<?= $attributeItem['id'] . '-' . $attributeValueItem['id'] . ' (' . $attributeValueItem['value_name'] . ') ' ?>" id="<?= $attributeValueItem['id'] ?>">
		                                            <label class="form-check-label" for="<?= $attributeValueItem['id'] ?>">
		                                                <?= $attributeValueItem['value_name'] ?>
		                                            </label>
		                                        </div>

		                                <?php }
                                        } ?>

		                            </div>
		                        <?php } ?>

		                    </div>
		                    <div class="m-3 d-flex justify-content-end">
		                        <button id="add-variant" class="btn btn-secondary" type="button"> <i class="fa fa-plus"></i> Tạo ra biến thể </button>
		                    </div>
		                </div>



		                <!-- Biến thể -->
		                <div class="card mb-3">
		                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
		                        <h6 class="mb-0 fw-bold ">Biến thể</h6>
		                    </div>
		                    <div class="card-body">
		                        <div class="row g-3 align-items-center">
		                            <div class="col-md-12">
		                                <div class="product-cart">
		                                    <div class="checkout-table table-responsive">
		                                        <table id="myCartTable" class="table display dataTable table-hover align-middle" style="width:100%">
		                                            <thead>
		                                                <tr>
		                                                    <th class="product">Kết hợp</th>
		                                                    <th class="product">Giá</th>
		                                                    <th class="product">Giá khuyễn mãi</th>
		                                                    <th class="quantity">Thực thi</th>
		                                                </tr>
		                                            </thead>
		                                            <tbody id="form-variant">
		                                                <tr>
		                                                    <td id="no-variant" colspan="4" class="text-center border-0 ">Chưa có biến thể..</td>
		                                                </tr>
		                                                <!-- <tr id="form-input-item-${itemCounter}">
																<td>
																	<input type="hidden" name="attribute[]" value="${attributeValue}">
																	<input type="text" readonly class="form-control" value="${nameValueAttribute}" placeholder="Tên kết hợp">
																</td>
																<td>

																	<input type="number" class="form-control" name="price_variant[]">
																</td>
																<td>

																	<input type="number" class="form-control" name="sale_price_variant[]">
																</td>

																<td>
																	<div class="btn-group" role="group" aria-label="Basic outlined example">
																		<button type="button" onclick="delItemVariant('form-input-item-${itemCounter}')" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
																	</div>
																</td>
															</tr> -->

		                                            </tbody>
		                                        </table>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>



		            </div><!-- Row end  -->
		        </form>
		    </div>
		</div>


		<!-- Xử lý tạo ra biến thể -->
		<script>
		    let itemCounter = 1;
		    $('#add-variant').click(() => {
		        $('#no-variant').remove()
		        let selectedAttributes = $('.product-variant input[type="radio"]:checked');
		        let attributeData = generateCombinations(selectedAttributes);

		        //Lay ra id cua attribute and value attribute
		        let attributeValue = attributeData.match(/\d+-\d+/g).join(', ');
		        //Ten value attribute
		        let nameValueAttribute = attributeData.match(/\(\s*([^)]+?)\s*\)/g).join(', ');


		        const newVariant = `
       									<tr id="form-input-item-${itemCounter}">
																<td>
																	<input type="hidden" name="attribute[]" value="${attributeValue}">
																	<input type="text" readonly class="form-control" value="${nameValueAttribute}" placeholder="Tên kết hợp">
																</td>
																<td>

																	<input type="number" class="form-control" name="price_variant[]">
																</td>
																<td>

																	<input type="number" class="form-control" name="sale_price_variant[]">
																</td>

																<td>
																	<div class="btn-group" role="group" aria-label="Basic outlined example">
																		<button type="button" onclick="delItemVariant('form-input-item-${itemCounter}')" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
																	</div>
																</td>
															</tr>
              `
		        itemCounter++


		        $('#form-variant').append(newVariant)
		    })


		    function generateCombinations(attributes) {
		        var combinations = [
		            []
		        ];

		        attributes.each(function() {
		            var attributeValues = $(this).val().split(' ');
		            var firstValue = attributeValues.shift();

		            if (attributeValues.length > 0) {
		                firstValue = [firstValue, attributeValues.join(' ')].join(' ');
		            }

		            var currentCombinations = [];

		            combinations.forEach(function(combination) {
		                currentCombinations.push(combination.concat(firstValue));
		            });

		            combinations = currentCombinations;
		        });

		        return combinations.join(' , ');
		    }


		    const delItemVariant = (idName) => {
		        const itemEle = $(`#${idName}`)
		        itemEle.remove();
		    }
		</script>