<?php

global $wpdb;
$getIdentified = intval( $_GET['id'] );

if( !empty( $_GET['action'] ) ):

	if( $_GET['action'] == 'delete' ):
		$wpdb->query( "DELETE FROM `wp_payments` WHERE ID = $getIdentified" );
		?><script>location.href="http://wacowla.com/wp-admin/admin.php?page=pph_plugin"</script><?

	elseif ( $_GET['action'] == 'preview' ):
		$query = $wpdb->prepare( "SELECT * FROM `wp_payments` WHERE ID = $getIdentified" );
		$payments = $wpdb->get_results( $query, OBJECT );

	?>

	<div class="wrap">
		<div id="icon-users" class="icon32">
			<br />
		</div>
		<h2>
			<?php echo _e( 'Magazine Subscriptions', 'solostream' );?>
			<a class="add-new-h2" href="http://wacowla.com/wp-admin/admin.php?page=pph_plugin"><? _e('Back','solostream'); ?></a>
		</h2>
		<br />
		<table class="widefat">
			<?php foreach( $payments as $payment ): ?>
				<tr>
					<th><?php _e('Transaction ID :', 'solostream'); ?></th>
					<td><?php echo $payment->txnid; ?></td>
				</tr>
				<tr>
					<th><?php _e('Subscriber: ', 'solostream'); ?></th>
					<td><?php echo $payment->firstname . " " . $payment->lastname; ?></td>
				</tr>
				<tr>
					<th><?php _e('Contact E-mail: ', 'solostream'); ?></th>
					<td><?php echo $payment->email; ?></td>
				</tr>
				<tr>
					<th><?php _e('Item Name', 'solostream'); ?></th>
					<td><?php echo $payment->itemname; ?></td>
				</tr>
				<tr>
					<th><?php _e('Item Amount: ', 'solostream'); ?></th>
					<td><?php echo $payment->payment_amount;?></td>
				</tr>
				<tr>
					<th><?php _e('Item Status: ', 'solostream'); ?></th>
					<td><?php echo $payment->payment_status;?></td>
				</tr>
				<tr>
					<th><?php _e('Item ID: ', 'solostream'); ?></th>
					<td><?php echo $payment->itemid; ?></td>
				</tr>
				<tr>
					<th><?php _e('Transact Time: ', 'solostream'); ?></th>
					<td><?php echo $payment->createdtime; ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	
	<? endif; ?>

<? else:
	$query = $wpdb->prepare( "SELECT * FROM `wp_payments` ORDER BY ID DESC" );
	$payments = $wpdb->get_results( $query, OBJECT ); 
?>

<div class="wrap">
	<div id="icon-users" class="icon32">
		<br />
	</div>
	<h2>
		<?php echo _e( 'Magazine Subscriptions', 'solostream' ); ?>
	</h2>
	<br />
	<table class="widefat">
		<tr>
			<th>Transaction ID</th>
			<th>Payment Amount</th>
			<th>Payment Status</th>
			<th>Item ID</th>
			<th>Date</th>
		</tr>
		<?php if( !empty( $payments ) ): ?>
			<?php foreach( $payments as $payment ): ?>
				<tr>
					<td><?php echo $payment->txnid; ?>
						<div class="row-actions">
							<span class="view">
								<a href="/wp-admin/admin.php?page=pph_plugin&action=preview&id=<?php echo $payment->id; ?>">View</a>
							</span>
							<span> | </span>
							<span class="delete">
								<a href="/wp-admin/admin.php?page=pph_plugin&action=delete&id=<?php echo $payment->id; ?>">Delete</a>
							</span>
						</div>
					</td>
					<td><?php echo $payment->payment_amount; ?></td>
					<td><?php echo $payment->payment_status; ?></td>
					<td><?php echo $payment->itemid; ?></td>
					<td><?php echo $payment->createdtime; ?></td>
				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="3">
					<div class="error">
						<h3><center><?php _e('No Transactions Yet'); ?><center></h3>
					</div>
				</td>
			</tr>
		<?php endif; ?>		
	</table>
</div>
<?php endif; ?>