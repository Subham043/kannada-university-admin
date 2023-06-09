<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover">


<?php $this->load->view('includes/common_head'); ?>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php $this->load->view('includes/header'); ?>

        <?php $this->load->view('includes/menu'); ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php $this->load->view('includes/breadcrumb'); ?>


                    <div class="row mt-5">

                        <!--end col-->
                        <div class="col-lg-12">
                            <form id="countryForm" method="post" action="<?php echo base_url('publisher/create'); ?>" enctype="multipart/form-data">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1"><?php echo $page_name; ?></h4>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row gy-4">
                                                <div class="col-xxl-4 col-md-4">
                                                    <div class="mb-3">
                                                        <label for="code" class="form-label"><?php echo $page_name; ?> Code</label>
                                                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter publisher code" value="<?php echo set_value('code'); ?>">
                                                        <div class="invalid-message"><?php echo form_error('code'); ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-4">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label"><?php echo $page_name; ?> Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter publisher name" value="<?php echo set_value('name'); ?>">
                                                        <div class="invalid-message"><?php echo form_error('name'); ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-4 col-md-4">
                                                    <div class="mb-3">
                                                        <label for="place" class="form-label"><?php echo $page_name; ?> Place</label>
                                                        <input type="text" class="form-control" id="place" name="place" placeholder="Enter publisher place" value="<?php echo set_value('place'); ?>">
                                                        <div class="invalid-message"><?php echo form_error('place'); ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-12 col-md-12">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label"><?php echo $page_name; ?> Address</label>
                                                        <textarea name="address" id="address" placeholder="Enter publisher address" class="form-control"><?php echo set_value('address'); ?></textarea>
                                                        <div class="invalid-message"><?php echo form_error('address'); ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label"><?php echo $page_name; ?> Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter publisher email" value="<?php echo set_value('email'); ?>">
                                                        <div class="invalid-message"><?php echo form_error('email'); ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label"><?php echo $page_name; ?> Phone</label>
                                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter publisher phone" value="<?php echo set_value('phone'); ?>">
                                                        <div class="invalid-message"><?php echo form_error('phone'); ?></div>
                                                    </div>
                                                </div>
                                                <input  autocomplete="off"  type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                <!--end col-->
                                                <div class="col-xxl-12 col-md-12">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn">Create</button>
                                                </div>

                                            </div>
                                            <!--end row-->
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div>
                <!-- container-fluid -->
            </div><!-- End Page-content -->

            <?php $this->load->view('includes/footer'); ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!-- JAVASCRIPT -->
    <?php $this->load->view('includes/common_script'); ?>

    <!-- App js -->
    <script src="<?php echo base_url('assets/admin/js/main.js'); ?>"></script>

    <script type="text/javascript">
        // initialize the validation library
        const validation = new JustValidate('#countryForm', {
            errorFieldCssClass: 'is-invalid',
            focusInvalidField: true,
            lockForm: true,
        });
        // apply rules to form fields
        validation
            .addField('#code', [{
                    rule: 'required',
                    errorMessage: '<?php echo $page_name; ?> Code is required',
                },
                {
                    rule: 'customRegexp',
                    value: /^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i,
                    errorMessage: '<?php echo $page_name; ?> Code is invalid',
                },
            ])
            .addField('#name', [{
                    rule: 'required',
                    errorMessage: '<?php echo $page_name; ?> Name is required',
                },
                {
                    rule: 'customRegexp',
                    value: /^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i,
                    errorMessage: '<?php echo $page_name; ?> Name is invalid',
                },
            ])
            .addField('#place', [{
                    rule: 'required',
                    errorMessage: '<?php echo $page_name; ?> Place is required',
                },
                {
                    rule: 'customRegexp',
                    value: /^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i,
                    errorMessage: '<?php echo $page_name; ?> Place is invalid',
                },
            ])
            .addField('#address', [{
                    rule: 'required',
                    errorMessage: '<?php echo $page_name; ?> Address is required',
                },
                {
                    rule: 'customRegexp',
                    value: /^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i,
                    errorMessage: '<?php echo $page_name; ?> Address is invalid',
                },
            ])
            .addField('#phone', [{
                    rule: 'required',
                    errorMessage: '<?php echo $page_name; ?> Phone is required',
                },
                {
                    rule: 'customRegexp',
                    value: /^[0-9]*$/,
                    errorMessage: '<?php echo $page_name; ?> Phone is invalid',
                },
            ])
            .addField('#email', [
                {
                rule: 'required',
                errorMessage: 'Email is required',
                },
                {
                rule: 'email',
                errorMessage: 'Email is invalid!',
                },
            ])
            .onSuccess((event) => {
                event.target.submit();
            })

        
    </script>


</body>


</html>