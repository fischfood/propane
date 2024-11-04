<form method="post" name="front_end" action="" >
	<label>Food Name</label>
	<input type="text" name="food_name" size="45" id="input-food_name" placeholder="Name of the dish"/>
	<label>Prep Time</label>
	<input type="text" name="prep_time" size="45" id="input-prep_time" placeholder="ex. 30min"/>
	<label>Time/Temp</label>
	<input type="text" name="time_temp" size="45" id="input-time_temp" placeholder="ex. 350º for 45min"/>
	<label>Person Making</label>
	<input type="text" name="person_making" size="45" id="input-person_making" placeholder="ex. 350º for 45min"/>
	<label>URL</label>
	<input type="text" name="url" size="45" id="input-url"/>
	<label>Occasion</label>
	<?php wp_dropdown_categories( 'orderby=name&hide_empty=0&exclude=1&hierarchical=1&taxonomy=occasion&name=occasion_field&value_field=name' ); ?>
	<?php /*
	<label>Making or Request?</label>
	<?php wp_dropdown_categories( 'orderby=name&hide_empty=0&exclude=1&hierarchical=1&taxonomy=food_planning_type&name=food_planning_type_field&value_field=name' ); ?>
	*/ ?>
	<label>Notes</label>
	<input type="text" name="notes" size="45" id="input-notes" placeholder="Notes, if necessary"/>
	<input type="submit" value="submit" />
	<input type="hidden" name="action" value="food-planning-submission" />
</form>
