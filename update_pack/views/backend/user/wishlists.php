
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-account-circle title_icon"></i> <?php echo get_phrase('wishlists'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('wishlists'); ?></h4>
                <table id="basic-datatable" class="table table-striped dt-responsive table-bordered nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('cover'); ?></th>
                            <th><?php echo get_phrase('title'); ?></th>
                            <th><?php echo get_phrase('categories'); ?></th>
                            <th><?php echo get_phrase('uploaded_by'); ?></th>
                            <th><?php echo get_phrase('status'); ?></th>
                            <th><?php echo get_phrase('date_added'); ?></th>
                        </tr>
                    </thead>
                    <tbody id = "listing_table">
                        <?php
                        $counter = 0;
                        $listings = $this->crud_model->get_user_wise_wishlist();
                        foreach ($listings as $listing): ?>
                        <tr>
                            <td><?php echo ++$counter; ?></td>
                            <td class="text-center"><img class = "rounded-circle img-thumbnail" src="<?php echo base_url('uploads/listing_cover_photo/'.$listing['listing_cover']); ?>" alt="" style="height: 50px; width: 50px;"></td>
                            <td><a href="<?php echo get_listing_url($listing['id']) ?>"><?php echo $listing['name']; ?></a></td>
                            <td>
                                <?php
                                $categories = json_decode($listing['categories']);
                                foreach ($categories as $category):
                                    $category_details = $this->crud_model->get_categories($category)->row_array();?>
                                    <span class="badge badge-secondary"><?php echo $category_details['name']; ?></span><br>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <?php
                                $user_details = $this->user_model->get_all_users($listing['user_id'])->row_array();
                                echo $user_details['name'];
                                ?>
                            </td>
                            <td><?php echo get_phrase($listing['status']); ?></td>
                            <td><?php echo date('D, d-M-Y', $listing['date_added']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
</div>

<script type="text/javascript">
function filterTable() {
    $('#preloader_gif').show();
    update_date_range();
    var status = $('#status_filter').val();
    var agent = $('#agent_filter').val();
    var date_range = $('#date_range').val();

    $.ajax({
        type : 'POST',
        url : '<?php echo site_url('user/filter_listing_table'); ?>',
        data : {status : status, agent : agent, date_range : date_range},
        success : function(response){
            console.log(response);
            $('#listing_table').html(response);
            $('#preloader_gif').hide();
        }
    })
}

function update_date_range()
{
    var x = $("#selectedValue").html();
    $("#date_range").val(x);
}
</script>
