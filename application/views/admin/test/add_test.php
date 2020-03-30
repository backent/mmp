<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-lg-7 col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="left">
					<h3 class="box-title"><?php echo trans('add_test'); ?></h3>
				</div>
				<div class="right">
					<a href="<?php echo admin_url(); ?>tests" class="btn btn-success btn-add-new">
						<i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?php echo trans('tests'); ?>
					</a>
				</div>
			</div><!-- /.box-header -->

			<!-- form start -->
			<?php echo form_open_multipart('test_admin_controller/add_test_post'); ?>

			<div class="box-body">
				<!-- include message block -->
				<?php $this->load->view('admin/includes/_messages_form'); ?>


				<div class="form-group">
					<label class="control-label"><?php echo trans("name"); ?>
						<small>(Max 1000 Char)</small>
					</label>
					<input type="text" class="form-control" name="name" placeholder="<?php echo trans("name"); ?>">
				</div>
			</div>

			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-primary pull-right"><?php echo trans('add_test'); ?></button>
			</div>
			<!-- /.box-footer -->
			<?php echo form_close(); ?><!-- form end -->
		</div>
		<!-- /.box -->
	</div>
</div>
