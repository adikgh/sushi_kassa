<? include "../config/core.php";

	// 
	if (!$user_id) header('location: /');



   	$type = @$_GET['type'];


	if (@$_GET['status'] && @$_GET['staff']) {
		$status = $_GET['status'];
		$staff = $_GET['staff'];
		if ($staff == 'off') $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and order_status = '$status' and сourier_id is null and branch_id = '$branch' order by number desc");
		elseif ($staff == 'soboi') $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and order_status = '$status' and order_type = 2 and branch_id = '$branch' order by number desc");
		else $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and order_status = '$status' and сourier_id  = '$staff'  and branch_id = '$branch' order by number desc");
	} elseif (@$_GET['status']) {
		$status = $_GET['status'];
		$orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and order_status = '$status'  and branch_id = '$branch' order by number desc");
	} elseif (@$_GET['staff']) {
		$staff = $_GET['staff'];
		if ($staff == 'off') $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and order_type = 1 and сourier_id is null and branch_id = '$branch' order by number desc");
		elseif ($staff == 'soboi') $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and order_type = 2 and branch_id = '$branch' order by number desc");
		else $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate' and сourier_id  = '$staff'  and branch_id = '$branch' order by number desc");
	} else $orders = db::query("select * from retail_orders where ins_dt BETWEEN '$start_cdate' and '$end_cdate'  and branch_id = '$branch' order by number desc");


	$allorder['total'] = 0;
	$allorder['pay_qr'] = 0;
	$allorder['pay_delivery'] = 0;


	// site setting
	$menu_name = 'orders';
	$pod_menu_name = 'main';
	$css = ['orders'];
	$js = ['orders'];
?>
<? include "../block/header.php"; ?>

	<div class="flex_clm_rev">

		<div class="bl_c">

			<div class="uc_u">

				<? if ($orders != ''): ?>
					<? if (mysqli_num_rows($orders) != 0): ?>
						<? while ($buy_d = mysqli_fetch_assoc($orders)): ?>
							<? // if ($buy_d['branch_id']) $branch_d = fun::branch($buy_d['branch_id']); ?>

							<div class="uc_ui">
								<div class="uc_uil2" >
									<div class="uc_uil2_top">
										<div class="uc_uil2_nmb"><?=$buy_d['number']?></div>
										<div class="uc_uil2_date">
											<!-- <div class="uc_uil2_date1"><?//=$branch_d['name']?></div> -->
											<div class=""><?//=date("d-m-Y", strtotime($buy_d['ins_dt']))?> ⌛ <?=date("H:i", strtotime($buy_d['ins_dt']))?></div>
										</div>
									</div>
									<div class="uc_uil2_raz">
										<div class="uc_uil2_mi">
											<div class="uc_uil2_mi1">Адрес:</div>
											<div class="uc_uil2_mi2"><?=$buy_d['address']?></div>
										</div>
										<div class="uc_uil2_mi">
											<div class="uc_uil2_mi1">Номер:</div>
											<div class="uc_uil2_mi2 fr_phone"><?=$buy_d['phone']?></div>
										</div>
									</div>
									<div class="uc_uil2_raz">
										<div class="uc_uil2_trt">
											<div class="uc_uil2_trt1">Атауы</div>
											<div class="uc_uil2_trt2">Саны</div>
											<div class="uc_uil2_trt3">Бағасы</div>
										</div>
										<div class="uc_uil2_trc">

											<? 	
												$cashbox_id = $buy_d['id'];
												$cashboxp = db::query("select * from retail_orders_products where order_id = '$cashbox_id' order by ins_dt asc");
												$number = 0; $total = 0;
											?>
											<? if (mysqli_num_rows($cashboxp) != 0): ?>
												<? while ($sel_d = mysqli_fetch_assoc($cashboxp)): ?>
													<? 
														$number++; 
														$sum = $sel_d['quantity'] * $sel_d['price']; 
														$total = $total + $sum;
														$product_d = product::product($sel_d['product_id']);
													?>
													<div class="uc_uil2_trt">
														<div class="uc_uil2_trt1"><?=$number?>. <?=$product_d['name_ru']?></div>
														<div class="uc_uil2_trt2"><?=$sel_d['quantity']?> шт</div>
														<!-- <div class=""><?=$sel_d['price']?></div> -->
														<div class="uc_uil2_trt3 fr_price"><?=$sum?></div>
													</div>
												<? endwhile ?>
											<? endif ?>
											
											<div class="uc_uil2_trt">
												<div class="uc_uil2_trt1">Доставка</div>
												<div class="uc_uil2_trt3 fr_price"><?=$buy_d['pay_delivery']?></div>
											</div>
										</div>
										<div class="uc_uil2_trb">
											<div class="uc_uil2_trt1">Жалпы</div>
											<div class="uc_uil2_trt2"></div>
											<div class="uc_uil2_trt3 fr_price"><?=$buy_d['total']?></div>
										</div>
										<div class="uc_uil2_trc">
											<div class="uc_uil2_trt">
												<div class="uc_uil2_trt1">Предоплата</div>
												<div class="uc_uil2_trt2">-</div>
												<div class="uc_uil2_trt3 fr_price"><?=$buy_d['pay_qr']?></div>
											</div>
											<div class="uc_uil2_trt">
												<div class="uc_uil2_trt1">Курьерге (нал)</div>
												<div class="uc_uil2_trt2"></div>
												<div class="uc_uil2_trt3 fr_price"><?=$buy_d['total'] - $buy_d['pay_qr']?></div>
											</div>
										</div>
									</div>
									<div class="uc_uil2_raz">
										<div class="uc_uil2_mib">
											<a class="btn btn_cl on_ubd" data-id="<?=$buy_d['id']?>" href="/cashbox/?id=<?=$buy_d['id']?>&type=ubd">Изменить</a>
											<div class="btn  on_print" data-id="<?=$buy_d['id']?>">Печать</div>
										</div>
									</div>

									<!-- <div class="uc_uin_other fr_price"><?=$buy_d['pay_qr']?> </div> -->
									<!-- <div class="uc_uin_other fr_price"><?=$buy_d['total'] - $buy_d['pay_qr']?></div> -->
								</div>
							</div>

							<? 
								// $allorder['number'] = $allorder['number'] + 1;
								$allorder['pay_delivery'] = $allorder['pay_delivery'] + $buy_d['pay_delivery'] + 500;
							?>

						<? endwhile ?>
					<? else: ?> <div class="ds_nr"><i class="fal fa-smoking"></i><p>демалыс</p></div> <? endif ?>
				<? else: ?> <div class="ds_nr"><i class="fal fa-smoking"></i><p>демалыс</p></div> <? endif ?>

			</div>

			<!-- Осы қатарды қосу қажет -->
			<!-- <div class="uc_ukb">
				<div class="btn btn_gr">Барлығы орындалды</div>
			</div> -->

		</div>


	</div>

<? include "../block/footer.php"; ?>