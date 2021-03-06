<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-account-circle title_icon"></i> <?php echo get_phrase('add_new_city'); ?>
                  <a href="<?php echo site_url('admin/city_form/add'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_new_city'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="mb-3 header-title"><?php echo get_phrase('city_list'); ?></h4>
        <div class="table-responsive-sm">
          <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
            <thead>
              <tr>
                <th>#</th>
                <th><?php echo get_phrase('city_name'); ?></th>
                <th><?php echo get_phrase('country'); ?></th>
                <th><?php echo get_phrase('option'); ?></th>
              </tr>
            </thead>
            <tbody>
                <?php
                 $counter = 0;
                 foreach ($cities as $city): ?>
                    <tr>
                        <td><?php echo ++$counter; ?></td>

                        <td><?php echo $city['name']; ?></td>
                        <td>
                            <?php
                              $country_details = $this->crud_model->get_countries($city['country_id'])->row_array();
                              echo $country_details['name'];
                              ?>
                          </td>
                        <td style="text-align: center;">
                            <a href = "<?php echo site_url('admin/city_form/edit/'.$city['id']); ?>" class="btn btn-icon btn-outline-info btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo get_phrase('edit'); ?>" style="margin-right:5px;">
                                 <i class="mdi mdi-wrench"></i>
                            </a>
                            <a href = "#" class="btn btn-icon btn-outline-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo get_phrase('delete'); ?>" style="margin-right:5px;" onclick="confirm_modal('<?php echo site_url('admin/cities/delete/'.$city['id']); ?>');">
                                 <i class="dripicons-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>
