<section class="content-main">
    <form method="post" action="<?= base_url('admin/products/product-edit/' . $product['product_id']) ?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12">
                <div class="content-header">
                    <h2 class="content-title">Add New Product</h2>
                    <div>
                        <a href="<?= base_url('admin/products/products-list') ?>" class="btn btn-light rounded font-sm mr-5 text-body hover-up">Products List</a>
                        <button class="btn btn-md rounded font-sm hover-up">Save Product</button>
                    </div>
                </div>
                <?php
                if (isset($status)) :
                    if ($status) : ?>
                        <div class="alert alert-success"><?= @$msg ?></div>
                    <?php else : ?>
                        <div class="alert alert-danger"><?= @$msg ?></div>
                <?php endif;
                endif; ?>
            </div>
            <div class="col-lg-9">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Basic</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="product_name" class="form-label">Product title</label>
                            <input type="text" placeholder="Type here" name="name" value="<?= $product['name'] ?>" class="form-control" id="product_name" />
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Full description</label>
                            <textarea placeholder="Type here" name="descr" value="<?= $product['descr'] ?>" class="form-control" rows="4"><?= $product['descr'] ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label class="form-label">Regular price</label>
                                    <div class="row gx-2">
                                        <input placeholder="₹" name="price" value="<?= $product['price'] ?>" type="number" step="0.01" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label class="form-label">Promotional price</label>
                                    <input placeholder="₹" name="promo_price" value="<?= $product['promo_price'] ?>" type="number" step="0.01" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4 mb-4">
                                <label class="form-label">Tax rate</label>
                                <input type="number" placeholder="%" name="tax_rate" value="<?= $product['tax_rate'] ?>" class="form-control" id="product_name" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card end// -->
            </div>
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Media</h4>
                    </div>
                    <div class="card-body">
                        <div class="input-upload">
                            <img src="<?= asset_url('imgs/theme/upload.svg', 'assets/admin/') ?>" alt="" />
                            <input class="form-control" name="image" type="file" />
                        </div>
                    </div>
                </div>
                <!-- card end// -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Category</h4>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-sm-12 mb-3">
                                <select class="form-select" name="category_id">
                                    <?php foreach ($product_category as $pcat) : ?>
                                        <option value="<?= $pcat['category_id'] ?>" <?= $pcat['category_id'] == $product['category_id'] ? 'selected' : '' ?>><?= $pcat['descr'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- row.// -->
                    </div>
                </div>
                <!-- card end// -->
            </div>
        </div>
    </form>
</section>