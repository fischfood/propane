<?php if ( is_user_logged_in() ): ?>
	<form method="post" name="front_end" action="" >
		<label>Score</label>
		<input type="number" name="score" size="45" id="input-score" placeholder="Score"/>
		<label>Player Name</label>
		<input type="text" name="pinball_player" size="45" id="input-name" maxlength="3" placeholder="XXX"/>
		<label>Machine</label>
		<?php wp_dropdown_categories( 'orderby=name&hide_empty=0&exclude=1&hierarchical=1&taxonomy=machine&name=pinball_machine&value_field=name' ); ?>
		<input type="submit" value="submit" />
		<input type="hidden" name="action" value="pinball-submission" />
	</form>
<?php endif; ?>
