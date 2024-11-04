<form method="post" name="front_end" action="" >
	<label>Mileage</label>
	<input type="number" name="mileage" size="45" id="input-mileage" placeholder="Mileage, if necessary"/>
	<label>Date</label>
	<input type="date" id="maintenance-date" name="maintenance-date" value="<?php echo date('Y-m-d' ); ?>" max="<?php echo date('Y-m-d' ); ?>">
	<label>Car</label>
	<?php wp_dropdown_categories( 'orderby=name&hide_empty=0&exclude=1&hierarchical=1&taxonomy=vehicle&name=maintenance_vehicle&value_field=name' ); ?>
	<label>Type</label>
	<?php wp_dropdown_categories( 'orderby=name&hide_empty=0&exclude=1&hierarchical=1&taxonomy=maintenance_type&name=maintenance_type_field&value_field=name' ); ?>
	<label>Notes</label>
	<input type="text" name="notes" size="45" id="input-notes" placeholder="Notes, if necessary"/>
	<input type="submit" value="submit" />
	<input type="hidden" name="action" value="maintenance-submission" />
</form>
