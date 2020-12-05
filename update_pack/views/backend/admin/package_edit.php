<?php
    $package_details = $this->crud_model->get_packages($package_id)->row_array();
?>
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-account-circle title_icon"></i> <?php echo get_phrase('add_new_package'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-md-center">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <h4 class="mb-3 header-title"><?php echo get_phrase('package_form'); ?></h4>

                <form action="<?php echo site_url('admin/packages/edit/'.$package_id); ?>" method="post" role="form" class="form-horizontal form-groups-bordered">

                    <div class="form-group">
                        <label for="type"><?php echo get_phrase('package_type'); ?></label>
                        <select class="form-control select2 select2-hidden-accessible" data-toggle="select2" name="package_type" id="type" data-select2-id="type" tabindex="-1" aria-hidden="true" required>
                            <?php
                                if($package_details['package_type'] == 0){
                                    $free = 'selected';
                                    $paid = null;
                                }else{
                                    $free = null;
                                    $paid = 'selected';
                                }
                            ?>
                                <option value="0" id="free" <?php echo $free; ?>><?php echo get_phrase('free'); ?></option>
                                <option value="1" id="paid" <?php echo $paid; ?>><?php echo get_phrase('paid'); ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name"><?php echo get_phrase('package_name'); ?></label>
                        <input type="text" name = "name" id = "name" class="form-control" value="<?php echo $package_details['name']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="price"><?php echo get_phrase('price').'('.currency_code_and_symbol().')'; ?></label>
                        <input type="text" name = "price" id = "price" class="form-control" value="<?php echo $package_details['price']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="validity"><?php echo get_phrase('validity_in_days'); ?></label>
                        <div class="input-group">
                            <input type="number" name = "validity" id = "validity" class="form-control" aria-describedby="days-addon" min="1" value="<?php echo $package_details['validity']; ?>" required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="days-addon"><?php echo get_phrase('days'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="number_of_listings"><?php echo get_phrase('number_of_listings'); ?></label>
                        <input type="number" name = "number_of_listings" id = "number_of_listings" class="form-control" min="1" value="<?php echo $package_details['number_of_listings']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="number_of_categories"><?php echo get_phrase('number_of_categories'); ?></label>
                        <input type="number" name = "number_of_categories" id = "number_of_categories" class="form-control" min="1" value="<?php echo $package_details['number_of_categories']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="number_of_tags"><?php echo get_phrase('number_of_tags'); ?></label>
                        <input type="number" name = "number_of_tags" id = "number_of_tags" class="form-control" min="1" value="<?php echo $package_details['number_of_tags']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="number_of_photos"><?php echo get_phrase('number_of_photos'); ?></label>
                        <input type="number" name = "number_of_photos" id = "number_of_photos" class="form-control" min="1" value="<?php echo $package_details['number_of_photos']; ?>" required>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ability_to_add_video" value="1" name = "ability_to_add_video" <?php if($package_details['ability_to_add_video'] == 1) echo 'checked'; ?>>
                            <label class="custom-control-label" for="ability_to_add_video"><?php echo get_phrase('ability_to_add_video'); ?></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="ability_to_add_contact_form" value="1" name = "ability_to_add_contact_form" <?php if($package_details['ability_to_add_contact_form'] == 1) echo 'checked'; ?>>
                            <label class="custom-control-label" for="ability_to_add_contact_form"><?php echo get_phrase('ability_to_add_contact_form'); ?></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="is_recommended" value="1" name = "is_recommended" <?php if($package_details['is_recommended'] == 1) echo 'checked'; ?>>
                            <label class="custom-control-label" for="is_recommended"><?php echo get_phrase('mark_this_package_as_recommended'); ?></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="featured" value="1" name = "featured" <?php if($package_details['featured'] == 1) echo 'checked'; ?>>
                            <label class="custom-control-label" for="featured"><?php echo get_phrase('featured_listings'); ?></label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"><?php echo get_phrase('save'); ?></button>
                </form>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>