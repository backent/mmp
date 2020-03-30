<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
	<div class="box-header with-border">
		<div class="left">
			<h3 class="box-title"><?php echo trans('tests'); ?></h3>
		</div>
		<div class="right">
			<a href="<?php echo admin_url(); ?>add-test" class="btn btn-success btn-add-new">
				<i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo trans('add_test'); ?>
			</a>
		</div>
	</div><!-- /.box-header -->

	<div class="box-body">
		<div class="row">
			<!-- include message block -->
			<div class="col-sm-12">
				<?php $this->load->view('admin/includes/_messages'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table table-bordered table-striped" role="grid">
						<?php $this->load->view('admin/test/_filter_tests'); ?>
						<thead>
						<tr role="row">
							<th width="20"><input type="checkbox" class="checkbox-table" id="checkAll"></th>
							<th width="20"><?php echo trans('id'); ?></th>
							<th><?php echo trans('name'); ?></th>
							<th><?php echo trans('date'); ?></th>
							<th class="max-width-120"><?php echo trans('options'); ?></th>
						</tr>
						</thead>
						<tbody>

						<?php foreach ($tests as $item): ?>
							<tr>
								<td><input type="checkbox" name="checkbox-table" class="checkbox-table" value="<?php echo $item->id; ?>"></td>
								<td><?php echo html_escape($item->id); ?></td>
								<td><?php echo html_escape($item->name); ?></td>
								<td><?php echo $item->created_at; ?></td>
								<td>
									<div class="dropdown">
										<button class="btn bg-purple dropdown-toggle btn-select-option"
												type="button"
												data-toggle="dropdown"><?php echo trans('select_option'); ?>
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu options-dropdown">
											<li>
												<a href="<?php echo admin_url(); ?>update-test/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
											</li>
											<li>
												<a href="javascript:void(0)" onclick="delete_item('test_admin_controller/delete_test_post','<?php echo $item->id; ?>','<?php echo trans("confirm_test"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
											</li>
										</ul>
									</div>
								</td>
							</tr>

						<?php endforeach; ?>

						</tbody>
					</table>

					<?php if (empty($tests)): ?>
						<p class="text-center">
							<?php echo trans("no_records_found"); ?>
						</p>
					<?php endif; ?>
					<div class="col-sm-12 table-ft">
						<div class="row">

							<div class="pull-right">
								<?php echo $this->pagination->create_links(); ?>
							</div>
							<?php if (count($tests) > 0): ?>
								<div class="pull-left">
									<button class="btn btn-sm btn-danger btn-table-delete" onclick="delete_selected_tests('<?php echo trans("confirm_tests"); ?>');"><?php echo trans('delete'); ?></button>
								</div>
							<?php endif; ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div><!-- /.box-body -->
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<?php echo form_open('product_admin_controller/add_remove_promoted_tests'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?php echo trans('add_to_promoted'); ?></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label><?php echo trans('day_count'); ?></label>
					<input type="hidden" class="form-control" name="product_id" id="day_count_product_id" value="">
					<input type="hidden" class="form-control" name="is_ajax" value="0">
					<input type="number" class="form-control" name="day_count" placeholder="<?php echo trans('day_count'); ?>" value="1" min="1" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>">
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success"><?php echo trans("submit"); ?></button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo trans("close"); ?></button>
			</div>
			<?php echo form_close(); ?><!-- form end -->
		</div>

	</div>
</div>
