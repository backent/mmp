<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-lg-7 col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo trans("update_test"); ?></h3>
			</div>
			<!-- /.box-header -->

			<!-- form start -->
			<?php echo form_open_multipart('test_admin_controller/update_test_post'); ?>

			<input type="hidden" name="id" value="<?php echo $test->id; ?>">

			<div class="box-body">

				<div class="form-group">
					<label class="control-label"><?php echo trans('name'); ?> (<?php echo trans('name'); ?>)</label>
					<input type="text" class="form-control" name="name"
						  placeholder="<?php echo trans('name'); ?>" value="<?php echo html_escape($test->name); ?>">
				</div>


			</div>


			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?> </button>
			</div>
			<!-- /.box-footer -->
			<?php echo form_close(); ?><!-- form end -->
		</div>
		<!-- /.box -->
	</div>
</div>
