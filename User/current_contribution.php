<?php
require 'connection.php';
include 'contribution_schedule_db.php';

echo '<div class="loan-details">';
echo '<div class="loan-card">';
echo '<p><b>Current Member Being Contributed:</b></p><br>';
echo '<p><b>Member ID :</b> ' . $member_id . '</p>';
echo '<p><b>Full Name :</b> ' . $fullName . '</p>';
echo '<p><b>Email :</b> ' . $email . '</p>';
echo '<p><b>Phone Number :</b> ' . $phone_number . '</p>';
echo '</div>';

echo '<div class="loan-card">';
echo '<p><b>Contribution Details:</b></p><br>';
echo '<p><b>Total Amount To Be Contributed By Each Member :</b> ' . $cont_amount . '</p>';
echo '<p><b>DateLine :</b> ' . $cont_dateline . '</p><br>';
echo '<button class="btn-submit">Contribute Now</button>';
echo '</div>';

// Payment Modal
echo '<div id="contPaymentModal" class="modal">';
echo '<div class="modal-content">';
echo '<form id="paymentProof" action="paymentProof_contribution.php" method="post">';
echo '<span class="close">&times;</span>';
echo '<h2>Payment Proof for Your Contribution:</h2><br>';
echo '<div class="form-group">';
echo '<label for="payment_method">Loan Type:</label>';
echo '<select id="payment_method" name="payment_method" onchange="showPaymentDetails()">';
echo '<option value="Default">Click to Select Payment Method</option>';
echo '<option value="Mpesa">Mpesa Paybill</option>';
echo '<option value="Bank">Bank Transfer</option>';
echo '</select><br><br>';

// Mpesa paybill option
echo '<div id="mpesa" style="display:none">';
echo '<h3>Mpesa Paybill</h3>';
echo '<ul>';
echo '<li>Paybill - <b>247247</b></li>';
echo '<li>Account Number - <b>1840179997117</b></li>';
echo '</ul>';
echo '</div>';

// Bank transfer option
echo '<div id="bank_transfer" style="display:none">';
echo '<h3>Bank Transfer</h3>';
echo '<ul>';
echo '<li>Bank Name - <b>Equity Bank</b></li>';
echo '<li>Account Number - <b>1840179997117</b></li>';
echo '</ul>';
echo '</div>';
echo '</div><br>';
echo '<small id="paymentCodeLabel" style="display:none">Enter the Payment Code here (Mpesa or Bank Code you received after paying).</small>';

// Form Hidden Inputs and Submit Button
echo '<div class="form-group">';
echo '<input type="hidden" id="memberId" name="memberId" value="' . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '') . '">';
echo '</div>';
echo '<div class="form-group">';
echo '<input type="hidden" id="contribution_id" name="contribution_id" value="' . $contribution_id . '">';
echo '</div>';
echo '<div class="form-group" id="paymentCodeGroup" style="display:none">';
echo '<input type="text" id="paymentCode" name="paymentCode" placeholder="e.g. SEK7TJJD2Z">';
echo '</div>';
echo '<div class="form-group">';
echo '<input type="hidden" id="purpose" name="purpose" value="contribution">';
echo '</div>';
echo '<button type="submit" id="submitButton" style="display:none">Submit</button>';
echo '</form>';
echo '</div>';
echo '</div>';
?>
