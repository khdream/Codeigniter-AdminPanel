<?php
$listing_details = $this->crud_model->get_listings($listing_id)->row_array();
$time_configuration_details = $this->crud_model->get_time_configuration_by_listing_id($listing_id)->row_array();
$social_links = json_decode($listing_details['social'], true);
$countries  = $this->db->get('country')->result_array();
$categories = $this->db->get('category')->result_array();
$listing_amenities = json_decode($listing_details['amenities'], false);
$listing_categories = json_decode($listing_details['categories'], false);
?>
<div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title"> <i class="mdi mdi-account-circle title_icon"></i> <?php echo get_phrase('update').': '.$listing_details['name']; ?></h4>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <h4 class="header-title mb-3"><?php echo get_phrase('edit_listing'); ?></h4>
        <form action="<?php echo site_url('admin/listings/edit/'.$listing_id); ?>" method="post" role="form" class="form-horizontal form-groups-bordered listing_edit_form" enctype="multipart/form-data">

          <div id="basicwizard">
            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
              <li class="nav-item">
                <a href="#first" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                  <i class="mdi mdi-account-circle mr-1"></i>
                  <span class="d-none d-sm-inline"><?php echo get_phrase('basic'); ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#second" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                  <i class="mdi mdi-face-profile mr-1"></i>
                  <span class="d-none d-sm-inline"><?php echo get_phrase('location'); ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#third" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                  <i class="mdi mdi-face-profile mr-1"></i>
                  <span class="d-none d-sm-inline"><?php echo get_phrase('amenities'); ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#forth" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                  <i class="mdi mdi-face-profile mr-1"></i>
                  <span class="d-none d-sm-inline"><?php echo get_phrase('media'); ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#fifth" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                  <i class="mdi mdi-face-profile mr-1"></i>
                  <span class="d-none d-sm-inline"><?php echo 'SEO'; ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#sixth" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                  <i class="mdi mdi-face-profile mr-1"></i>
                  <span class="d-none d-sm-inline"><?php echo get_phrase('schedule'); ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#seventh" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                  <i class="mdi mdi-face-profile mr-1"></i>
                  <span class="d-none d-sm-inline"><?php echo get_phrase('contact'); ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#eighth" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                  <i class="mdi mdi-face-profile mr-1"></i>
                  <span class="d-none d-sm-inline"><?php echo get_phrase('type'); ?></span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#finish" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                  <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                  <span class="d-none d-sm-inline"><?php echo get_phrase('finish'); ?></span>
                </a>
              </li>
            </ul>

            <div class="tab-content mb-0 b-0">

              <div class="tab-pane" id="first">
                <div class="row justify-content-center">
                  <div class="col-lg-8">
                    <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="title"><?php echo get_phrase('title'); ?></label>
                      <div class="col-md-10">
                        <input type="hidden" name="user_id" value="<?php echo $listing_details['user_id']?>">
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $listing_details['name']; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="description"> <?php echo get_phrase('description'); ?></label>
                      <div class="col-md-10">
                        <textarea name="description" id = "description" class="form-control" rows="8" cols="80" required><?php echo $listing_details['description']; ?></textarea>
                      </div>
                    </div>

                    <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="featured_type"> <?php echo get_phrase('featured_type'); ?></label>
                      <div class="col-md-10">
                        <select class="form-control select2" data-toggle="select2" name="is_featured" id = "featured_type" required>
                          <option value=""><?php echo get_phrase('select_featured_type'); ?></option>
                          <option value="1"  <?php if($listing_details['is_featured'] == 1) echo 'selected'; ?>><?php echo get_phrase('featured'); ?></option>
                          <option value="0" <?php if($listing_details['is_featured'] == 0) echo 'selected'; ?>><?php echo get_phrase('none_featured'); ?></option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="category"> <?php echo get_phrase('category'); ?></label>
                      <div class="col-md-10">
                        <div id="category_area">
                            <?php foreach ($listing_categories as $key => $listing_category): ?>
                                <?php if ($key == 0): ?>
                                <div class="row">
                                    <div class="col-xl-10 pr-0">
                                        <select class="form-control select2" data-toggle="select2" name="categories[]" id = "category_default" required>
                                            <option value=""><?php echo get_phrase('select_category'); ?></option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?php echo $category['id']; ?>" <?php if ($category['id'] == $listing_category): ?> selected <?php endif; ?>><?php echo $category['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-2">
                                        <button type="button" class="btn btn-primary btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="appendCategory()"> <i class="fa fa-plus"></i> </button>
                                    </div>
                                </div>

                                <?php else: ?>
                                    <div class="row mt-2 appendedCategoryFields">
                                        <div class="col-xl-10 pr-0">
                                            <select class="form-control select2" data-toggle="select2" name="categories[]">
                                                <option value=""><?php echo get_phrase('select_category'); ?></option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?php echo $category['id']; ?>" <?php if ($category['id'] == $listing_category): ?> selected <?php endif; ?>><?php echo $category['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-xl-2">
                                            <button type="button" class="btn btn-danger btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="removeCategory(this)"> <i class="fa fa-minus"></i> </button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>

                        <div id="blank_category_field">
                          <div class="row mt-2 appendedCategoryFields">
                            <div class="col-10 pr-0">
                              <select class="form-control select2" data-toggle="select2" name="categories[]">
                                <option value=""><?php echo get_phrase('select_category'); ?></option>
                                <?php foreach ($categories as $category): ?>
                                  <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-2">
                              <button type="button" class="btn btn-danger btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="removeCategory(this)"> <i class="fa fa-minus"></i> </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> <!-- end col -->
                </div> <!-- end row -->
              </div>

              <div class="tab-pane fade" id="second">
                <div class="row justify-content-center">
                  <div class="col-lg-8">

                    <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="country_id"> <?php echo get_phrase('country'); ?></label>
                      <div class="col-md-10">
                        <select class="form-control select2" data-toggle="select2" name="country_id" id="country_id" onchange="getCityList(this.value)">
                          <option value=""><?php echo get_phrase('select_country'); ?></option>
                          <?php foreach ($countries as $country): ?>
                              <option value="<?php echo $country['id']; ?>" <?php if($listing_details['country_id'] == $country['id']): ?> selected <?php endif;?>><?php echo $country['name']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="city_id"> <?php echo get_phrase('city'); ?></label>
                      <div class="col-md-10">
                        <select class="form-control select2" data-toggle="select2" name="city_id" id="city_id">
                          <?php foreach ($this->crud_model->get_cities_by_country_id($listing_details['country_id'])->result_array() as $city): ?>
                              <option value="<?php echo $city['id']; ?>" <?php if($listing_details['city_id'] == $city['id']): ?> selected <?php endif;?>><?php echo $city['name']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="address"><?php echo get_phrase('address'); ?></label>
                      <div class="col-md-10">
                        <textarea name="address" rows="5" class="form-control" id = "address"><?php echo $listing_details['address']; ?></textarea>
                      </div>
                    </div>

                    <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="latitude"><?php echo get_phrase('latitude'); ?></label>
                      <div class="col-md-10">
                        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="<?php echo get_phrase('you_can_provide_latitude_for_getting_the_exact_result'); ?>" value="<?php echo $listing_details['latitude']; ?>">
                      </div>
                    </div>

                    <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="longitude"><?php echo get_phrase('longitude'); ?></label>
                      <div class="col-md-10">
                        <input type="text" class="form-control" id="longitude" name="longitude" placeholder="<?php echo get_phrase('you_can_provide_longitude_for_getting_the_exact_result'); ?>" value="<?php echo $listing_details['longitude']; ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="third">
                <div class="row justify-content-center">
                  <div class="col-lg-8">
                    <div class="row">
                      <?php $amenities = $this->crud_model->get_amenities();
                      foreach ($amenities->result_array() as $amenity):?>
                      <div class="col-lg-4 mb-1">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="amenities[]" id="<?php echo $amenity['id']; ?>" value="<?php echo $amenity['id']; ?>" <?php echo in_array($amenity['id'], $listing_amenities) ? "checked" : "";;?>>
                            <label class="custom-control-label" for="<?php echo $amenity['id']; ?>"><i class="<?php echo $amenity['icon']; ?>" style="color: #636363;"></i> <?php echo $amenity['name']; ?></label>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="forth">
              <div class="row justify-content-center">
                <div class="col-lg-8">

                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="longitude"><?php echo get_phrase('listing_thumbnail'); ?> <small>(460 X 306)</small> </label>
                    <div class="col-md-10">
                      <div class="d-flex">
                          <div class="">
                              <img class = "rounded-circle img-thumbnail" src="<?php echo base_url('uploads/listing_thumbnails/'.$listing_details['listing_thumbnail']); ?>" alt="" style="height: 50px; width: 50px;">
                          </div>
                          <div class="flex-grow-1 mt-1 pl-3">
                              <div class="input-group">
                                  <div class="custom-file">
                                      <input type="file" class="custom-file-input" name = "listing_thumbnail" id="listing_thumbnail" onchange="changeTitleOfImageUploader(this)" accept="image/*">
                                      <label class="custom-file-label ellipsis" for="listing_thumbnail"><?php echo $listing_details['listing_thumbnail']; ?></label>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="longitude"><?php echo get_phrase('listing_cover'); ?> <br/> <small>(1600 X 600)</small> </label>
                    <div class="col-md-10">
                      <div class="d-flex">
                          <div class="">
                              <img class = "rounded-circle img-thumbnail" src="<?php echo base_url('uploads/listing_cover_photo/'.$listing_details['listing_cover']); ?>" alt="" style="height: 50px; width: 50px;">
                          </div>
                          <div class="flex-grow-1 mt-1 pl-3">
                              <div class="input-group">
                                  <div class="custom-file">
                                      <input type="file" class="custom-file-input" name = "listing_cover" id="listing_cover" onchange="changeTitleOfImageUploader(this)" accept="image/*">
                                      <label class="custom-file-label ellipsis" for="listing_cover"><?php echo $listing_details['listing_cover']; ?></label>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="listing_images"><?php echo get_phrase('listing_gallery_images'); ?><br/> <small>(960 X 640)</small> </label>
                    <div class="col-md-10">
                      <div id="photos_area">
                        <?php if (count(json_decode($listing_details['photos'])) > 0): ?>
                          <?php foreach (json_decode($listing_details['photos']) as $key => $photo): ?>

                              <?php if ($key == 0): ?>
                                  <div class="d-flex mb-1">
                                      <div class="">
                                          <img class = "rounded-circle img-thumbnail" src="<?php echo base_url('uploads/listing_images/'.$photo); ?>" alt="" style="height: 50px; width: 50px;">
                                      </div>
                                      <div class="flex-grow-1 px-3">
                                          <div class="input-group">
                                              <div class="custom-file">
                                                  <input type="file" class="custom-file-input" name = "listing_images[]" id="" onchange="changeTitleOfImageUploader(this)" accept="image/*">
                                                  <input type="hidden" class="name_of_previous_image" name="new_listing_images[]" value="<?php echo $photo; ?>">
                                                  <label class="custom-file-label ellipsis" for=""><?php echo $photo; ?></label>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="">
                                          <button type="button" class="btn btn-primary btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="appendPhotoUploader()"> <i class="fa fa-plus"></i> </button>
                                      </div>
                                  </div>
                              <?php else: ?>
                                  <div class="d-flex mb-1 appendedPhotoUploader">
                                      <div class="">
                                          <img class = "rounded-circle img-thumbnail" src="<?php echo base_url('uploads/listing_images/'.$photo); ?>" alt="" style="height: 50px; width: 50px;">
                                      </div>
                                      <div class="flex-grow-1 px-3">
                                          <div class="input-group">
                                              <div class="custom-file">
                                                  <input type="file" class="custom-file-input" name = "listing_images[]" id="" onchange="changeTitleOfImageUploader(this)" accept="image/*">
                                                  <input type="hidden" class="name_of_previous_image" name="new_listing_images[]" value="<?php echo $photo; ?>">
                                                  <label class="custom-file-label ellipsis" for=""><?php echo $photo; ?></label>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="">
                                          <button type="button" class="btn btn-danger btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="removePhotoUploader(this)"> <i class="fa fa-minus"></i> </button>
                                      </div>
                                  </div>
                              <?php endif; ?>

                          <?php endforeach; ?>
                        <?php else: ?>
                          <div class="d-flex mb-1">
                              <div class="">
                                  <img class = "rounded-circle img-thumbnail" src="<?php echo base_url('uploads/placeholder.png'); ?>" alt="" style="height: 50px; width: 50px;">
                              </div>
                              <div class="flex-grow-1 px-3">
                                  <div class="input-group">
                                      <div class="custom-file">
                                          <input type="file" class="custom-file-input" name = "listing_images[]" id="" onchange="changeTitleOfImageUploader(this)" accept="image/*">
                                          <input type="hidden" class="name_of_previous_image" name="new_listing_images[]" value="">
                                          <label class="custom-file-label ellipsis" for=""><?php echo get_phrase('choose_file'); ?></label>
                                      </div>
                                  </div>
                              </div>
                              <div class="">
                                  <button type="button" class="btn btn-primary btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="appendPhotoUploader()"> <i class="fa fa-plus"></i> </button>
                              </div>
                          </div>
                        <?php endif; ?>
                      </div>
                      <div id="blank_photo_uploader">
                          <div class="d-flex mt-2 appendedPhotoUploader">
                              <div class="">
                                  <img class = "rounded-circle img-thumbnail" src="<?php echo base_url('uploads/placeholder.png'); ?>" alt="" style="height: 50px; width: 50px;">
                              </div>
                              <div class="flex-grow-1 px-3">
                                  <div class="input-group">
                                      <div class="custom-file">
                                          <input type="file" class="custom-file-input" name = "listing_images[]" id="" onchange="changeTitleOfImageUploader(this)" accept="image/*">
                                          <input type="hidden" class="name_of_previous_image" name="new_listing_images[]" value="">
                                          <label class="custom-file-label ellipsis" for=""><?php echo get_phrase('choose_file'); ?></label>
                                      </div>
                                  </div>
                              </div>
                              <div class="">
                                  <button type="button" class="btn btn-danger btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="removePhotoUploader(this)"> <i class="fa fa-minus"></i> </button>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="video_provider"> <?php echo get_phrase('video_provider'); ?></label>
                    <div class="col-md-10">
                      <select class="form-control select2" data-toggle="select2" name="video_provider" id="video_provider">
                        <option value="youtube" <?php if($listing_details['video_provider'] == 'youtube'): ?> selected <?php endif; ?>>YouTube</option>
                        <option value="vimeo" <?php if($listing_details['video_provider'] == 'vimeo'): ?> selected <?php endif; ?>>Vimeo</option>
                        <option value="html5" <?php if($listing_details['video_provider'] == 'html5'): ?> selected <?php endif; ?>>HTML5</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="video_url"><?php echo get_phrase('video_url'); ?></label>
                    <div class="col-md-10">
                      <input type="text" class="form-control" id="video_url" name="video_url" placeholder="<?php echo get_phrase('you_can_provide_video_url'); ?>" value="<?php echo $listing_details['video_url']; ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="fifth">
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="tags"><?php echo get_phrase('tags'); ?></label>
                    <div class="col-md-10">
                      <div class="form-group">
                        <input type="text" class="form-control bootstrap-tag-input" id = "tags" name="tags" data-role="tagsinput" style="width: 100%;" value="<?php echo $listing_details['tags']; ?>"/>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="SEO_meta_tags"><?php echo get_phrase('SEO_meta_tags'); ?></label>
                    <div class="col-md-10">
                      <div class="form-group">
                        <input type="text" class="form-control" id = "seo_meta_tags" name="seo_meta_tags" data-role="tagsinput" style="width: 100%;" value="<?php echo $listing_details['seo_meta_tags']; ?>"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="sixth">
              <div class="row justify-content-center">
                <?php $days = array('saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'); ?>
                <div class="col-lg-8">
                  <div class="form-group row mb-3">
                    <?php foreach($days as $day):
                    $interval_array = explode('-', $time_configuration_details[$day]); ?>
                        <div class="col-xl-6">
                            <label><?php echo get_phrase($day.'_opening'); ?></label>
                            <select class="form-control select2" data-toggle="select2" name="<?php echo $day.'_opening'; ?>" id="<?php echo $day.'_opening'; ?>">
                              <?php for($i = 0; $i <= 24; $i++): ?>
                                <?php if ($i < 24): ?>
                                  <option value="<?php echo $i; ?>" <?php if($interval_array[0] == $i): ?> selected <?php endif; ?>> <?php echo date('h a', strtotime("$i:00:00")) ?> </option>
                                <?php else: ?>
                                  <option value="closed" <?php if($interval_array[0] == 'closed'): ?> selected <?php endif; ?> ><?php echo get_phrase('closed'); ?></option>
                                <?php endif; ?>
                              <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-xl-6">
                            <label><?php echo get_phrase($day.'_closing'); ?></label>
                            <select class="form-control select2" data-toggle="select2" name="<?php echo $day.'_closing'; ?>" id="<?php echo $day.'_closing'; ?>">
                                <?php for($i = 0; $i <= 24; $i++): ?>
                                  <?php if ($i < 24): ?>
                                    <option value="<?php echo $i; ?>" <?php if($interval_array[1] == $i): ?> selected <?php endif; ?>><?php echo date('h a', strtotime("$i:00:00")) ?></option>
                                  <?php else: ?>
                                    <option value="closed" <?php if($interval_array[1] == 'closed'): ?> selected <?php endif; ?> ><?php echo get_phrase('closed'); ?></option>
                                  <?php endif; ?>
                                <?php endfor; ?>
                            </select>
                        </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>


            <div class="tab-pane fade" id="seventh">
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="website"><?php echo get_phrase('website'); ?></label>
                    <div class="col-md-10">
                      <input type="text" class="form-control" id="website" name="website" placeholder="<?php echo get_phrase('website'); ?>" value="<?php echo $listing_details['website']; ?>">
                    </div>
                  </div>

                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="email"><?php echo get_phrase('email'); ?></label>
                    <div class="col-md-10">
                      <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo get_phrase('email'); ?>" value="<?php echo $listing_details['email']; ?>">
                    </div>
                  </div>

                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="phone_number"><?php echo get_phrase('phone_number'); ?></label>
                    <div class="col-md-10">
                      <input type="text" class="form-control" id="phone_number" name="phone" placeholder="<?php echo get_phrase('phone_number'); ?>" value="<?php echo $listing_details['phone']; ?>">
                    </div>
                  </div>

                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="facebook"><?php echo get_phrase('facebook'); ?></label>
                    <div class="col-md-10">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon-facebook"> <i class="mdi mdi-facebook"></i> </span>
                        </div>
                        <input type="text" class="form-control" name="facebook" placeholder="www.facebook.com/xyz/" aria-label="facebook" aria-describedby="basic-addon-facebook" value="<?php echo $social_links['facebook']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="twitter"><?php echo get_phrase('twitter'); ?></label>
                    <div class="col-md-10">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon-twitter"> <i class="mdi mdi-twitter"></i> </span>
                        </div>
                        <input type="text" class="form-control" name="twitter" placeholder="www.twitter.com/xyz/" aria-label="twitter" aria-describedby="basic-addon-twitter" value="<?php echo $social_links['twitter']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="linkedin"><?php echo get_phrase('linkedin'); ?></label>
                    <div class="col-md-10">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon-linkedin"> <i class="mdi mdi-linkedin"></i> </span>
                        </div>
                        <input type="text" class="form-control" name="linkedin" placeholder="www.linkedin.com/xyz/" aria-label="linkedin" aria-describedby="basic-addon-linkedin" value="<?php echo $social_links['linkedin']; ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="eighth">
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <div id = "listing_type_div" class="mb-3">
                    <div class="row justify-content-center">
                      <div class="col-lg-4 col-6 mb-1">
                        <div class="col-lg-12 mb-1">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="general" name="listing_type" class="custom-control-input" value="general" onclick="showListingTypeForm('general')" <?php if($listing_details['listing_type'] == 'general'): ?> checked = "checked" <?php endif; ?>>
                            <label class="custom-control-label" for="general"><i class="fa fa-hotel" style="color: #636363;"></i> <?php echo get_phrase('general'); ?></label>
                          </div>
                        </div>

                        <div class="col-lg-12 mb-1">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="hotel" name="listing_type" class="custom-control-input" value="hotel" onclick="showListingTypeForm('hotel')" <?php if($listing_details['listing_type'] == 'hotel'): ?> checked = "checked" <?php endif; ?>>
                            <label class="custom-control-label" for="hotel"><i class="fa fa-hotel" style="color: #636363;"></i> <?php echo get_phrase('hotel'); ?> </label>
                          </div>
                        </div>

                        <div class="col-lg-12 mb-1">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="restaurant" name="listing_type" class="custom-control-input" value="restaurant" onclick="showListingTypeForm('restaurant')" <?php if($listing_details['listing_type'] == 'restaurant'): ?> checked = "checked" <?php endif; ?>>
                            <label class="custom-control-label" for="restaurant"><i class="fa fa-hotel" style="color: #636363;"></i> <?php echo get_phrase('restaurant'); ?></label>
                          </div>
                        </div>

                        <div class="col-lg-12 mb-1">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="shop" name="listing_type" class="custom-control-input" value="shop" onclick="showListingTypeForm('shop')" <?php if($listing_details['listing_type'] == 'shop'): ?> checked = "checked" <?php endif; ?>>
                            <label class="custom-control-label" for="shop"><i class="fa fa-hotel" style="color: #636363;"></i> <?php echo get_phrase('shop'); ?></label>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-4 col-6 mb-1 text-center">
                        <a href="#" id = "demo-btn" class="btn btn-primary mt-4" onclick="showListingTypeWiseDemo($('.listing-type-radio').val())"> <i class="mdi mdi-eye"></i> <?php echo get_phrase('no_preview_available'); ?> </a>
                      </div>
                    </div>
                  </div>

		              <?php include 'special_offer_form_for_editing.php'; ?>
                  <?php include 'restaurant_food_menu_form_for_editing.php'; ?>
                  <?php include 'hotel_room_specification_form_for_editing.php'; ?>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="finish">
                <div class="row">
                  <div class="col-12">
                    <div class="text-center">
                      <h2 class="mt-0">
                        <i class="mdi mdi-check-all"></i>
                      </h2>
                      <h3 class="mt-0"><?php echo get_phrase('thank_you'); ?> !</h3>
                      <p class="w-75 mb-2 mx-auto"><?php echo get_phrase('you_are_almost_there').'. '.get_phrase('please_check_if_you_have_provided_all_the_necessary_things').'.'; ?></p>
		                  <p> <input type="button" class="btn btn-primary" name="button" value="<?php echo get_phrase('submit'); ?>" onclick="checkMinimumFieldRequired()"></p>
                      </div>
                    </div>
                    <!-- end col -->
                  </div>
                  <!-- end row -->
                </div>

                <ul class="list-inline wizard mt-3" style="text-align: center;">
                  <li class="previous list-inline-item"><a href="#" class="btn btn-info"> <i class="mdi mdi-arrow-left-bold"></i> </a></li>
                  <li class="next list-inline-item"><a href="#" class="btn btn-info"> <i class="mdi mdi-arrow-right-bold"></i> </a></li>
                </ul>

              </div> <!-- tab-content -->
            </div> <!-- end #rootwizard-->
          </form>

        </div> <!-- end card-body -->
      </div>
    </div>
  </div>
  <script type="text/javascript">
  function getCityList(country_id) {
    $.ajax({
      type : 'POST',
      url : '<?php echo site_url('home/get_city_list_by_country_id'); ?>',
      data : {country_id : country_id},
      success : function(response) {
        $('#city_id').html(response);
      }
    });
  }
  var blank_category = $('#blank_category_field').html();
  var blank_photo_uploader = $('#blank_photo_uploader').html();
  var blank_special_offer_div = $('#blank_special_offer_div').html();
  var blank_food_menu_div = $('#blank_food_menu_div').html();
  var blank_hotel_room_specification_div = $('#blank_hotel_room_specification_div').html();
  var listing_type_value = $('.listing-type-radio').val();

  $(document).ready(function() {
    $('#blank_category_field').hide();
    $('#blank_photo_uploader').hide();
    $('#blank_special_offer_div').hide();
    $('#blank_food_menu_div').hide();
    $('#blank_hotel_room_specification_div').hide();
    showListingTypeForm('<?php echo $listing_details['listing_type']; ?>');
  });

  function appendHotelRoomSpecification() {

    jQuery('#hotel_room_specification_div').append(blank_hotel_room_specification_div);
    let selector = jQuery('#hotel_room_specification_div .hotel_room_specification_div');

    let rand = Math.random().toString(36).slice(3);

    $(selector[selector.length - 1]).find('label.btn').attr('for', 'room-image-' + rand );
    $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'room-image-' + rand );
    $(".bootstrap-tag-input").tagsinput('items');
    initImagePreviewer();
  }

  function removeHotelRoomSpecification(elem) {
    jQuery(elem).closest('.hotel_room_specification_div').remove();
    $(".bootstrap-tag-input").tagsinput('items');
  }

  function appendFoodMenu() {

    jQuery('#food_menu_div').append(blank_food_menu_div);
    let selector = jQuery('#food_menu_div .food_menu_div');

    let rand = Math.random().toString(36).slice(3);

    $(selector[selector.length - 1]).find('label.btn').attr('for', 'menu-image-' + rand );
    $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'menu-image-' + rand );
    $(".bootstrap-tag-input").tagsinput('items');
    initImagePreviewer();
  }

  function removeFoodMenu(elem) {
    jQuery(elem).closest('.food_menu_div').remove();
    $(".bootstrap-tag-input").tagsinput('items');
    removeFromDatabase('food_menu', elem.id);
  }

  function appendSpecialOffer() {

    jQuery('#special_offer_div').append(blank_special_offer_div);
    let selector = jQuery('#special_offer_div .special_offer_div');

    let rand = Math.random().toString(36).slice(3);

    $(selector[selector.length - 1]).find('label.btn').attr('for', 'product-image-' + rand );
    $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'product-image-' + rand );
    $(".bootstrap-tag-input").tagsinput('items');
    initImagePreviewer();
  }

  function removeSpecialOffer(elem) {
    jQuery(elem).closest('.special_offer_div').remove();
    $(".bootstrap-tag-input").tagsinput('items');
    removeFromDatabase('product', elem.id);
  }

  function appendCategory() {
    jQuery('#category_area').append(blank_category);
  }

  function removeCategory(categoryElem) {
    jQuery(categoryElem).closest('.appendedCategoryFields').remove();
  }

  function appendPhotoUploader() {
    jQuery('#photos_area').append(blank_photo_uploader);
  }

  function removePhotoUploader(photoElem) {
    jQuery(photoElem).closest('.appendedPhotoUploader').remove();
  }

  function showListingTypeForm(listing_type) {
  	listing_type_value = listing_type;
  	if (listing_type === "shop") {
  		$('#special_offer_parent_div').show();
  		$('#food_menu_parent_div').hide();
  		$('#hotel_room_specification_parent_div').hide();
  		$('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('preview_products'); ?>');
  	}
  	else if (listing_type === "hotel") {
  		$('#special_offer_parent_div').hide();
  		$('#food_menu_parent_div').hide();
  		$('#hotel_room_specification_parent_div').show();
  		$('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('preview_rooms'); ?>');
  	}
  	else if (listing_type === "restaurant") {
  		$('#special_offer_parent_div').hide();
  		$('#food_menu_parent_div').show();
  		$('#hotel_room_specification_parent_div').hide();
  		$('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('preview_food_menu'); ?>');
  	}else {
  		$('#special_offer_parent_div').hide();
  		$('#food_menu_parent_div').hide();
  		$('#hotel_room_specification_parent_div').hide();
  		$('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('no_preview_available'); ?>');
  	}
  }

  function removeFromDatabase(type, id) {
    $.ajax({
      type : 'POST',
      url : '<?php echo site_url('admin/remove_listing_inner_feature'); ?>',
      data : {type : type, id : id},
      success : function(response) {
        success_notify('<?php echo get_phrase('removed_successfully'); ?>');
      }
    });
  }

  // This fucntion checks the minimul required fields of listing form
  function checkMinimumFieldRequired() {
  	var title = $('#title').val();
  	var defaultCategory = $('#category_default').val();
  	var latitude = $('#latitude').val();
  	var longitude = $('#longitude').val();
  	if (title === "" || defaultCategory === "" || latitude === "" || longitude === "") {
  		error_notify('<?php echo get_phrase('listing_title').', '.get_phrase('listing_category').', '.get_phrase('latitude').', '.get_phrase('longitude').' '.get_phrase('can_not_be_empty'); ?>');
  	}else {
  		$('.listing_edit_form').submit();
  	}
  }

  // Show Listing Type Wise Demo
  function showListingTypeWiseDemo(param) {
  	if (listing_type_value === 'hotel') {
  		showAjaxModal('<?php echo base_url();?>modal/popup/preview_of_details/hotel_room', '<?php echo get_phrase('preview'); ?>');
  	}
  	if (listing_type_value === 'restaurant') {
  		showAjaxModal('<?php echo base_url();?>modal/popup/preview_of_details/food_menu', '<?php echo get_phrase('preview'); ?>');
  	}
  	if (listing_type_value === 'shop') {
  		showAjaxModal('<?php echo base_url();?>modal/popup/preview_of_details/special_offers', '<?php echo get_phrase('preview'); ?>');
  	}
  }
</script>
