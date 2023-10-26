<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Products List</h2>
        </div>
        <div>
            <a href="#" class="btn btn-light rounded font-md">Export</a>
            <a href="#" class="btn btn-light rounded font-md">Import</a>
            <a href="<?= base_url('admin/products/product-create') ?>" class="btn btn-primary btn-sm rounded">Create new</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php
            if (isset($status)) :
                if ($status) : ?>
                    <div class="alert alert-success"><?= @$msg ?></div>
                <?php else : ?>
                    <div class="alert alert-danger"><?= @$msg ?></div>
            <?php endif;
            endif; ?>
        </div>
    </div>
    <div class="card mb-4">
        <header class="card-header">
            <div class="row align-items-center">
                <div class="col col-check flex-grow-0">
                    <div class="form-check ms-2">
                        <input class="form-check-input" type="checkbox" value="" />
                    </div>
                </div>
                <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                    <select class="form-select">
                        <option selected>All category</option>
                        <option>Electronics</option>
                        <option>Clothes</option>
                        <option>Automobile</option>
                    </select>
                </div>
                <div class="col-md-2 col-6">
                    <input type="date" value="02.05.2021" class="form-control" />
                </div>
                <div class="col-md-2 col-6">
                    <select class="form-select">
                        <option selected>Status</option>
                        <option>Active</option>
                        <option>Disabled</option>
                        <option>Show all</option>
                    </select>
                </div>
            </div>
        </header>
        <!-- card-header end// -->
        <div class="card-body">
            <?php if (!empty($products)) : foreach ($products as $product) : ?>
                    <article class="itemlist">
                        <div class="row align-items-center">
                            <div class="col col-check flex-grow-0">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-8 flex-grow-1 col-name">
                                <a class="itemside" href="#">
                                    <div class="left">
                                        <img src="<?= base_url($product['image']) ?>" class="img-sm img-thumbnail" alt="Item" />
                                    </div>
                                    <div class="info">
                                        <h6 class="mb-0"><?= $product['name'] ?></h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-4 col-price"><span><?= currency_format($product['price']) ?></span></div>
                            <div class="col-lg-2 col-sm-2 col-4 col-status">
                                <?php if ($product['status']) : ?>
                                    <span class="badge rounded-pill alert-success">Active</span>
                                <?php else : ?>
                                    <span class="badge rounded-pill alert-danger">Inactive</span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-1 col-sm-2 col-4 col-date">
                                <span>02.11.2021</span>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-4 col-action text-end">
                                <a href="<?= base_url('admin/products/product-edit/') . $product['product_id'] ?>" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-edit"></i></a>
                                <?php if ($product['status']) : ?>
                                    <a href="<?= base_url('admin/products/product-delete/') . $product['product_id'] ?>" class="btn btn-sm font-sm btn-light rounded"> <i class="material-icons md-delete_forever"></i> </a>
                                <?php else : ?>
                                    <a href="<?= base_url('admin/products/product-activate/') . $product['product_id'] ?>" class="btn btn-sm font-sm btn-light rounded"> <i class="material-icons md-check"></i> </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- row .// -->
                    </article>
                    <!-- itemlist  .// -->
            <?php endforeach;
            endif; ?>
        </div>
        <!-- card-body end// -->
    </div>
    <!-- card end// -->
    <div class="pagination-area mt-30 mb-50">
        <nav aria-label="Page navigation example">
            <?= $links ?>
        </nav>
    </div>
</section>