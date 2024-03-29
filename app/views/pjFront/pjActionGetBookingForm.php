<?php
include dirname(__FILE__) . '/elements/menu.php';
$STORAGE = @$_SESSION[$controller->defaultCalendar];
$jquery_validation = __('jquery_validation', true);
?>
<form action="" method="post" class="abForm abSelectorBookingForm">
	<input type="hidden" name="start_dt" value="<?php echo @$STORAGE['start_dt']; ?>" />
	<input type="hidden" name="end_dt" value="<?php echo @$STORAGE['end_dt']; ?>" />
	<div class="abBox abWhite abHeading"><?php __('bf_booking'); ?></div>
	<div class="abBox abGray">
		<div class="abParagraph">
			<div class="abParagraphInner">
				<label class="abTitle"><?php __('bf_start_date'); ?></label>
				<span class="abValue"><?php echo date($tpl['option_arr']['o_date_format'], @$STORAGE['start_dt']); ?></span>
			</div>
		</div>
		<div class="abParagraph">
			<div class="abParagraphInner">
				<label class="abTitle"><?php __('bf_end_date'); ?></label>
				<span class="abValue"><?php echo date($tpl['option_arr']['o_date_format'], @$STORAGE['end_dt']); ?></span>
			</div>
		</div>
		<div class="abParagraph">
			<div class="abParagraphInner">
				<label class="abTitle">&nbsp;</label>
				<span class="abValue">
					<?php
					$nights = ceil(($STORAGE['end_dt'] - $STORAGE['start_dt']) / 86400);
			    	if ($tpl['option_arr']['o_price_based_on'] == 'days')
			    	{
			    		$nights += 1;
			    		printf("%u %s", $nights, $nights > 1 ? __('bf_days', true) : __('bf_day', true));
			    	} else {
			    		printf("%u %s", $nights, $nights > 1 ? __('bf_nights', true) : __('bf_night', true));
			    	}
			    	?>&nbsp;(<a href="#" class="abSelectorChangeDates"><?php __('lblChangeDates');?></a>)
		    	</span>
		    </div>
		</div>
		<?php
		if ((int) $tpl['option_arr']['o_bf_adults'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php __('bf_adults'); ?></label>
					<span class="abControl">
						<select name="c_adults" class="abSelect abW80<?php echo (int) $tpl['option_arr']['o_bf_adults'] === 3 ? ' required' : NULL; ?>" data-msg-required="<?php echo $jquery_validation['required'];?>">
							<option value="">---</option>
							<?php
							foreach (range(1, $tpl['option_arr']['o_bf_adults_max']) as $i)
							{
								?><option value="<?php echo $i; ?>"<?php echo @$STORAGE['c_adults'] != $i ? NULL : ' selected="selected"'; ?>><?php echo $i; ?></option><?php
							}
							?>
						</select>
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_bf_children'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php __('bf_children'); ?></label>
					<span class="abControl">
						<select name="c_children" class="abSelect abW80<?php echo (int) $tpl['option_arr']['o_bf_children'] === 3 ? ' required' : NULL; ?>" data-msg-required="<?php echo $jquery_validation['required'];?>">
							<option value="">---</option>
							<?php
							foreach (range(0, $tpl['option_arr']['o_bf_children_max']) as $i)
							{
								?><option value="<?php echo $i; ?>"<?php echo @$STORAGE['c_children'] != $i ? NULL : ' selected="selected"'; ?>><?php echo $i; ?></option><?php
							}
							?>
						</select>
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_disable_payments'] !== 1 || (int) $tpl['option_arr']['o_show_prices'] === 1)
		{
			?><div class="abSelectorPrice"><?php include dirname(__FILE__) . '/pjActionGetPrice.php'; ?></div><?php
		}
		?>
	</div>
	<div class="abBox abWhite">

		<!-- SE AGREGA EL CHECK DEL SEGURO PARA ACTUALIZAR EL PRECIO			 -->
		<div class="abParagraph">
			<div class="abParagraphInner">
				<label class="abTitle">Fixed Price</label>
				<span class="abControl" style="text-align:left !important;">
					<input type="checkbox" name="updatePrice" id="ab_updatePrice_<?php echo $_GET['cid']; ?>" class="<?php echo (int) $tpl['option_arr']['o_bf_terms'] === 3 ? 'required': NULL; ?>" style="margin-left: 0;float: left; margin-right: 3px;" />
					<label for="ab_terms_<?php echo $_GET['cid']; ?>" class="abTerms"> Change your dates 24 hours before departure. &nbsp;
						<a href="https://iwanatrip.com/TermsConditions" target="_blank" style="font-weight: bold;text-align: center">Check Terms and Conditions</a>
					</label>
				</span>
			</div>
		</div>		
		<!-- SE AGREGA EL CHECK DEL SEGURO PARA ACTUALIZAR EL PRECIO			 -->

		<?php
		
		if ((int) $tpl['option_arr']['o_bf_name'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php __('bf_name'); ?></label>
					<span class="abControl">
						<input type="text" name="c_name" class="abText abStretch<?php echo (int) $tpl['option_arr']['o_bf_name'] === 3 ? ' required' : NULL; ?>" value="<?php echo htmlspecialchars(@$STORAGE['c_name']); ?>" data-msg-required="<?php echo $jquery_validation['required'];?>" />
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_bf_lastname'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php echo "Lastname"; ?></label>
					<span class="abControl">
						<input type="text" name="c_lastname" class="abText abStretch<?php echo (int) $tpl['option_arr']['o_bf_lastname'] === 3 ? ' required' : NULL; ?>" value="<?php echo htmlspecialchars(@$STORAGE['c_lastname']); ?>" data-msg-required="<?php echo $jquery_validation['required'];?>" />
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_bf_email'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php __('bf_email'); ?></label>
					<span class="abControl">
						<input type="text" name="c_email" class="abText abStretch email<?php echo (int) $tpl['option_arr']['o_bf_email'] === 3 ? ' required' : NULL; ?>" value="<?php echo htmlspecialchars(@$STORAGE['c_email']); ?>" data-msg-required="<?php echo $jquery_validation['required'];?>" data-msg-email="<?php echo $jquery_validation['email'];?>"/>
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_bf_cedula'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php echo "ID / Passport"; ?></label>
					<span class="abControl">
						<input type="text" name="c_cedula" class="abText abStretch<?php echo (int) $tpl['option_arr']['o_bf_cedula'] === 3 ? ' required' : NULL; ?>" value="<?php echo htmlspecialchars(@$STORAGE['c_cedula']); ?>" data-msg-required="<?php echo $jquery_validation['required'];?>" />
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_bf_phone'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php __('bf_phone'); ?></label>
					<span class="abControl">
						<input type="text" name="c_phone" class="abText abStretch<?php echo (int) $tpl['option_arr']['o_bf_phone'] === 3 ? ' required' : NULL; ?>" value="<?php echo htmlspecialchars(@$STORAGE['c_phone']); ?>" data-msg-required="<?php echo $jquery_validation['required'];?>"/>
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_bf_address'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php __('bf_address'); ?></label>
					<span class="abControl">
						<input type="text" name="c_address" class="abText abStretch<?php echo (int) $tpl['option_arr']['o_bf_address'] === 3 ? ' required' : ' required'; ?>" value="<?php echo htmlspecialchars(@$STORAGE['c_address']); ?>" data-msg-required="<?php echo $jquery_validation['required'];?>"/>
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_bf_zip'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php __('bf_zip'); ?></label>
					<span class="abControl">
						<input type="text" name="c_zip" class="abText abStretch<?php echo (int) $tpl['option_arr']['o_bf_zip'] === 3 ? ' required' : NULL; ?>" value="<?php echo htmlspecialchars(@$STORAGE['c_zip']); ?>" data-msg-required="<?php echo $jquery_validation['required'];?>"/>
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_bf_city'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php __('bf_city'); ?></label>
					<span class="abControl">
						<input type="text" name="c_city" class="abText abStretch<?php echo (int) $tpl['option_arr']['o_bf_city'] === 3 ? ' required' : NULL; ?>" value="<?php echo htmlspecialchars(@$STORAGE['c_city']); ?>" data-msg-required="<?php echo $jquery_validation['required'];?>"/>
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_bf_state'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php __('bf_state'); ?></label>
					<span class="abControl">
						<input type="text" name="c_state" class="abText abStretch<?php echo (int) $tpl['option_arr']['o_bf_state'] === 3 ? ' required' : NULL; ?>" value="<?php echo htmlspecialchars(@$STORAGE['c_state']); ?>" data-msg-required="<?php echo $jquery_validation['required'];?>"/>
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_bf_country'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php __('bf_country'); ?></label>
					<span class="abControl">
						<select name="c_country" class="abSelect abStretch<?php echo (int) $tpl['option_arr']['o_bf_country'] === 3 ? ' required' : NULL; ?>" data-msg-required="<?php echo $jquery_validation['required'];?>">
							<option value="">---</option>
							<?php
							foreach ($tpl['country_arr'] as $country)
							{
								?><option value="<?php echo $country['id']; ?>"<?php echo @$STORAGE['c_country'] != $country['id'] ? NULL : ' selected="selected"'; ?>><?php echo stripslashes($country['name']); ?></option><?php
							}
							?>
						</select>
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_bf_notes'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php __('bf_notes'); ?></label>
					<span class="abControl">
						<textarea name="c_notes" class="abTextarea abStretch abH70<?php echo (int) $tpl['option_arr']['o_bf_notes'] === 3 ? ' required' : NULL; ?>" data-msg-required="<?php echo $jquery_validation['required'];?>"><?php echo @$STORAGE['c_notes']; ?></textarea>
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_disable_payments'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner">
					<label class="abTitle"><?php __('bf_payment'); ?></label>
					<span class="abControl">
						<select name="payment_method" class="abSelect required" data-msg-required="<?php echo $jquery_validation['required'];?>">
							
							<?php
							foreach (__('payment_methods', true) as $k => $v)
							{
								if ((int) $tpl['option_arr']['o_allow_'.$k] !== 1)
								{
									continue;
								}
								?><option value="<?php echo $k; ?>"<?php echo @$STORAGE['payment_method'] != $k ? NULL : ' selected="selected"'; ?>><?php echo $v; ?></option><?php
							}
							?>
						</select>
					</span>
				</div>
			</div>

			<div class="abParagraph abBankWrap" style="display: <?php echo @$STORAGE['payment_method'] != 'bank' ? 'none' : NULL; ?>">
				<div class="abParagraphInner">
					<label class="abTitle"><?php __('bf_bank_account'); ?></label>
					<span class="abValue"><?php echo stripslashes(nl2br($tpl['option_arr']['o_bank_account'])); ?></span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_bf_captcha'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner" style="position: relative">
					<label class="abTitle"><?php __('bf_captcha'); ?></label>
					<span class="abControl">
						<!-- <img src="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionCaptcha&amp;cid=<?php echo $_GET['cid']; ?>&amp;rand=<?php echo rand(1, 99999); ?>" alt="<?php __('bf_captcha'); ?>" class="abCaptcha" /> -->
						<img id="pjAbcCaptchaImage" src="<?php echo PJ_INSTALL_URL; ?>index.php?controller=pjFront&amp;action=pjActionCaptcha&amp;cid=<?php echo $_GET['cid']; ?>&amp;rand=<?php echo rand(1, 99999); ?><?php echo isset($_GET['session_id']) ? '&session_id=' . $_GET['session_id'] : NULL;?>" alt="<?php __('bf_captcha'); ?>" class="abCaptcha" />						
						<input type="text" name="captcha" class="abText abW100<?php echo (int) $tpl['option_arr']['o_bf_captcha'] === 3 ? ' required' : NULL; ?>" maxlength="6" autocomplete="off" data-msg-required="<?php echo $jquery_validation['required'];?>"/>
					</span>
				</div>
			</div>
			<?php
		}
		if ((int) $tpl['option_arr']['o_bf_terms'] !== 1)
		{
			?>
			<div class="abParagraph">
				<div class="abParagraphInner" style="position: relative">
					<label class="abTitle">&nbsp;</label>
					<span class="abControl">
						<input type="checkbox" name="terms" id="ab_terms_<?php echo $_GET['cid']; ?>" value="1" class="<?php echo (int) $tpl['option_arr']['o_bf_terms'] === 3 ? 'required': NULL; ?>" style="margin-left: 0;float: left; margin-right: 3px;" data-msg-required="<?php echo $jquery_validation['required'];?>"/>
						<label for="ab_terms_<?php echo $_GET['cid']; ?>" class="abTerms"><?php
						if (!empty($tpl['cal_arr']['terms_url']) && preg_match('|^http(s)?://|', $tpl['cal_arr']['terms_url']))
						{
							printf(__('bf_terms', true), '<a href="'.$tpl['cal_arr']['terms_url'].'" target="_blank">', '</a>');
						} else if (!empty($tpl['cal_arr']['terms_body'])) {
							printf(__('bf_terms', true), '<a class="abSelectorTerms" href="#">', '</a>');
						} else {
							echo str_replace('%s', '', __('bf_terms', true));
						}
						?></label>
					</span>
				</div>
			</div>
			<div class="abSelectorTermsBody" style="display: none"><?php echo nl2br(stripslashes(htmlspecialchars($tpl['cal_arr']['terms_body']))); ?></div>
			<?php
		}
		?>

		<!-- SE AGREGA EL CAMPO PARA AGREGAR UN CUPON -->
		<div class="abParagraph">
			<div class="abParagraphInner">
			<label class="abTitle"><?php echo "Coupon"; ?></label>
				<span class="abControl" style="text-align: left !important;">
					<input type="text" name="cupon" id="cupon" class="abText abStretch<?php echo (int) $tpl['option_arr']['o_bf_notes'] === 3 ? NULL : NULL; ?>" />
					<label for="cupon" id="cuponError" style="color:#be3d21 !important; font-size: 1.0833em;"</label>					
				</span>
			</div>
		</div>
		<!-- SE AGREGA EL CAMPO PARA AGREGAR UN CUPON -->

		<div class="abParagraph">
			<div class="abParagraphInner">
				<label class="abTitle">&nbsp;</label>
				<span class="abControl">
					<button type="submit" id="envio" class="abButton abButtonDefault abSelectorContinue abFloatleft abMR5"><?php echo "Pay"; ?></button>
					<button type="button" class="abButton abButtonCancel abSelectorCancel abFloatleft"><?php __('bf_cancel'); ?></button>
				</span>
			</div>
		</div>
		<div class="abParagraph"></div>
	</div>
</form>
