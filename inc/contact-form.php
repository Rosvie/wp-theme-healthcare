<?php
/**
 * Site forms (rebuilt from the original site's contact, appointment,
 * referral, employment and testimonial forms).
 *
 * Shortcodes:
 *   [nhh_contact_form]            Compact "Send Us a Message" form (homepage style).
 *   [nhh_form type="contact"]     Full forms: contact | appointment | referral | employment | testimonial.
 *   [nhh_map]                     Google Map from the Customizer.
 *
 * Submissions are emailed with wp_mail() to the Customizer recipient.
 *
 * @package Northfield_Home_Health
 */

defined( 'ABSPATH' ) || exit;

/**
 * US states for select fields.
 *
 * @return array
 */
function nhh_us_states() {
	return array( 'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'District Of Columbia', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Puerto Rico', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virgin Islands', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming' );
}

/**
 * Form definitions.
 *
 * Field keys: label, type (text|email|tel|date|time|textarea|select|radio|checkboxes|file),
 * required, options, placeholder, wide (spans both columns), group (fieldset legend).
 *
 * @return array
 */
function nhh_form_definitions() {
	$positions = apply_filters(
		'nhh_job_positions',
		array(
			'RN field nurse; Springfield, MA',
			'RN field nurse; Worcester, MA',
			'LPN field nurse; Springfield, MA',
			'Assistant Clinical Director, Springfield, MA Home Office',
		)
	);

	$forms = array(
		'contact_short' => array(
			'title'  => __( 'Website message', 'northfield-home-health' ),
			'fields' => array(
				'full_name' => array( 'label' => __( 'Full Name', 'northfield-home-health' ), 'type' => 'text', 'required' => true ),
				'email'     => array( 'label' => __( 'Email Address', 'northfield-home-health' ), 'type' => 'email', 'required' => true ),
				'message'   => array( 'label' => __( 'Message', 'northfield-home-health' ), 'type' => 'textarea' ),
			),
		),
		'contact'       => array(
			'title'  => __( 'Contact form', 'northfield-home-health' ),
			'submit' => __( 'Submit', 'northfield-home-health' ),
			'fields' => array(
				'full_name' => array( 'label' => __( 'Full Name', 'northfield-home-health' ), 'type' => 'text', 'required' => true, 'placeholder' => __( 'Enter full name here', 'northfield-home-health' ) ),
				'address'   => array( 'label' => __( 'Address', 'northfield-home-health' ), 'type' => 'text', 'placeholder' => __( 'Enter address here', 'northfield-home-health' ) ),
				'email'     => array( 'label' => __( 'Email Address', 'northfield-home-health' ), 'type' => 'email', 'required' => true, 'placeholder' => 'example@domain.com' ),
				'phone'     => array( 'label' => __( 'Phone Number', 'northfield-home-health' ), 'type' => 'tel', 'placeholder' => '+1 (number)' ),
				'message'   => array( 'label' => __( 'Question / Comment', 'northfield-home-health' ), 'type' => 'textarea', 'wide' => true, 'placeholder' => __( 'Enter your question or comment here', 'northfield-home-health' ) ),
			),
		),
		'appointment'   => array(
			'title'  => __( 'Appointment request', 'northfield-home-health' ),
			'submit' => __( 'Request Appointment', 'northfield-home-health' ),
			'fields' => array(
				'full_name'    => array( 'label' => __( 'Name', 'northfield-home-health' ), 'type' => 'text', 'required' => true, 'placeholder' => __( 'Enter name here', 'northfield-home-health' ) ),
				'address'      => array( 'label' => __( 'Address', 'northfield-home-health' ), 'type' => 'text', 'placeholder' => __( 'Enter address here', 'northfield-home-health' ) ),
				'city'         => array( 'label' => __( 'City', 'northfield-home-health' ), 'type' => 'text', 'placeholder' => __( 'Enter city here', 'northfield-home-health' ) ),
				'state'        => array( 'label' => __( 'State', 'northfield-home-health' ), 'type' => 'select', 'options' => nhh_us_states(), 'default' => 'Massachusetts' ),
				'zip'          => array( 'label' => __( 'Zip Code', 'northfield-home-health' ), 'type' => 'text', 'placeholder' => __( 'Enter zip code here', 'northfield-home-health' ) ),
				'contact_pref' => array( 'label' => __( 'How do you prefer to be contacted?', 'northfield-home-health' ), 'type' => 'radio', 'options' => array( 'Phone', 'Fax', 'Email' ) ),
				'email'        => array( 'label' => __( 'Email Address', 'northfield-home-health' ), 'type' => 'email', 'required' => true, 'placeholder' => 'example@domain.com' ),
				'phone'        => array( 'label' => __( 'Phone Number', 'northfield-home-health' ), 'type' => 'tel', 'placeholder' => '+1 (number)' ),
				'fax'          => array( 'label' => __( 'Fax Number', 'northfield-home-health' ), 'type' => 'tel' ),
				'best_time'    => array( 'label' => __( 'Best time to call', 'northfield-home-health' ), 'type' => 'select', 'options' => array( 'Anytime', 'Morning at Home', 'Morning at Work', 'Afternoon at Home', 'Afternoon at Work', 'Evening at Home', 'Evening at Work' ) ),
				'pref_date'    => array( 'label' => __( 'Preferred Date', 'northfield-home-health' ), 'type' => 'date' ),
				'pref_time'    => array( 'label' => __( 'Preferred Time', 'northfield-home-health' ), 'type' => 'time' ),
				'message'      => array( 'label' => __( 'Comment', 'northfield-home-health' ), 'type' => 'textarea', 'wide' => true ),
			),
		),
		'referral'      => array(
			'title'  => __( 'Referral', 'northfield-home-health' ),
			'submit' => __( 'Send Referral', 'northfield-home-health' ),
			'fields' => array(
				'full_name'     => array( 'label' => __( 'Name of Referrer', 'northfield-home-health' ), 'type' => 'text', 'required' => true, 'placeholder' => __( 'Enter name of referrer here', 'northfield-home-health' ), 'group' => __( 'Referrer Information', 'northfield-home-health' ) ),
				'email'         => array( 'label' => __( 'Email Address', 'northfield-home-health' ), 'type' => 'email', 'required' => true, 'placeholder' => 'example@domain.com', 'group' => __( 'Referrer Information', 'northfield-home-health' ) ),
				'patient_name'  => array( 'label' => __( 'Name', 'northfield-home-health' ), 'type' => 'text', 'required' => true, 'placeholder' => __( 'Enter name here', 'northfield-home-health' ), 'group' => __( 'Person Being Referred', 'northfield-home-health' ) ),
				'patient_email' => array( 'label' => __( 'Email Address', 'northfield-home-health' ), 'type' => 'email', 'placeholder' => 'example@domain.com', 'group' => __( 'Person Being Referred', 'northfield-home-health' ) ),
				'patient_phone' => array( 'label' => __( 'Contact Number', 'northfield-home-health' ), 'type' => 'tel', 'required' => true, 'group' => __( 'Person Being Referred', 'northfield-home-health' ) ),
				'message'       => array( 'label' => __( 'Notes', 'northfield-home-health' ), 'type' => 'textarea', 'wide' => true, 'group' => __( 'Person Being Referred', 'northfield-home-health' ) ),
			),
		),
		'employment'    => array(
			'title'     => __( 'Employment application', 'northfield-home-health' ),
			'submit'    => __( 'Submit Application', 'northfield-home-health' ),
			'multipart' => true,
			'fields'    => array(
				'full_name'  => array( 'label' => __( 'Name', 'northfield-home-health' ), 'type' => 'text', 'required' => true, 'placeholder' => __( 'Enter name here', 'northfield-home-health' ) ),
				'email'      => array( 'label' => __( 'Email Address', 'northfield-home-health' ), 'type' => 'email', 'required' => true, 'placeholder' => 'example@domain.com' ),
				'address'    => array( 'label' => __( 'Address', 'northfield-home-health' ), 'type' => 'text', 'placeholder' => __( 'Enter address here', 'northfield-home-health' ) ),
				'city'       => array( 'label' => __( 'City', 'northfield-home-health' ), 'type' => 'text', 'placeholder' => __( 'Enter city here', 'northfield-home-health' ) ),
				'state'      => array( 'label' => __( 'State', 'northfield-home-health' ), 'type' => 'select', 'options' => nhh_us_states(), 'default' => 'Massachusetts' ),
				'zip'        => array( 'label' => __( 'Zip Code', 'northfield-home-health' ), 'type' => 'text', 'placeholder' => __( 'Enter zip code here', 'northfield-home-health' ) ),
				'phone'      => array( 'label' => __( 'Phone Number', 'northfield-home-health' ), 'type' => 'tel', 'required' => true, 'placeholder' => '+1 (number)' ),
				'position'   => array( 'label' => __( 'Position applying for', 'northfield-home-health' ), 'type' => 'select', 'options' => $positions ),
				'license'    => array( 'label' => __( 'What license do you currently hold?', 'northfield-home-health' ), 'type' => 'radio', 'options' => array( 'HHA', 'LPN', 'RN', 'Other' ) ),
				'license_other' => array( 'label' => __( 'Other license', 'northfield-home-health' ), 'type' => 'text', 'placeholder' => __( 'Please specify here', 'northfield-home-health' ) ),
				'over_18'    => array( 'label' => __( 'Are you over 18?', 'northfield-home-health' ), 'type' => 'radio', 'options' => array( 'Yes', 'No' ), 'required' => true ),
				'drivers_license' => array( 'label' => __( 'Do you have a driver’s license?', 'northfield-home-health' ), 'type' => 'radio', 'options' => array( 'Yes', 'No' ) ),
				'owns_car'   => array( 'label' => __( 'Do you own a car?', 'northfield-home-health' ), 'type' => 'radio', 'options' => array( 'Yes', 'No' ) ),
				'shifts'     => array( 'label' => __( 'What shifts would you prefer?', 'northfield-home-health' ), 'type' => 'checkboxes', 'options' => array( 'Days', 'PM', 'Nights', 'Live-in' ) ),
				'experience' => array( 'label' => __( 'Previous Experience', 'northfield-home-health' ), 'type' => 'textarea', 'wide' => true ),
				'resume'     => array( 'label' => __( 'Attach Resume (PDF, DOC, DOCX — max 5 MB)', 'northfield-home-health' ), 'type' => 'file', 'accept' => '.pdf,.doc,.docx' ),
				'heard'      => array( 'label' => __( 'How did you hear about us?', 'northfield-home-health' ), 'type' => 'text' ),
			),
		),
		'testimonial'   => array(
			'title'  => __( 'Testimonial', 'northfield-home-health' ),
			'submit' => __( 'Share Your Experience', 'northfield-home-health' ),
			'fields' => array(
				'full_name' => array( 'label' => __( 'Name', 'northfield-home-health' ), 'type' => 'text', 'required' => true ),
				'city'      => array( 'label' => __( 'City / Town', 'northfield-home-health' ), 'type' => 'text' ),
				'email'     => array( 'label' => __( 'Email Address', 'northfield-home-health' ), 'type' => 'email', 'required' => true, 'placeholder' => 'example@domain.com' ),
				'message'   => array( 'label' => __( 'Your Testimonial', 'northfield-home-health' ), 'type' => 'textarea', 'required' => true, 'wide' => true ),
			),
		),
	);

	return apply_filters( 'nhh_form_definitions', $forms );
}

/**
 * Status notice after a redirect.
 *
 * @param string $type Form type rendered.
 * @return string
 */
function nhh_form_notice( $type ) {
	// phpcs:disable WordPress.Security.NonceVerification.Recommended -- display only.
	$status = isset( $_GET['nhh_contact'] ) ? sanitize_key( wp_unslash( $_GET['nhh_contact'] ) ) : '';
	$which  = isset( $_GET['nhh_form'] ) ? sanitize_key( wp_unslash( $_GET['nhh_form'] ) ) : '';
	// phpcs:enable
	if ( '' === $status || ( $which && $which !== $type ) ) {
		return '';
	}
	$messages = array(
		'sent'    => array( 'ok', __( 'Thank you! Your submission has been sent. We will get back to you shortly.', 'northfield-home-health' ) ),
		'invalid' => array( 'error', __( 'Please complete all required fields with a valid email address and accept the privacy policy.', 'northfield-home-health' ) ),
		'file'    => array( 'error', __( 'Your resume must be a PDF, DOC or DOCX file under 5 MB.', 'northfield-home-health' ) ),
		'failed'  => array( 'error', __( 'Sorry, your submission could not be sent. Please call or email us directly.', 'northfield-home-health' ) ),
	);
	if ( ! isset( $messages[ $status ] ) ) {
		return '';
	}
	return sprintf(
		'<p class="form-notice form-notice--%1$s" role="%2$s">%3$s</p>',
		esc_attr( $messages[ $status ][0] ),
		'ok' === $messages[ $status ][0] ? 'status' : 'alert',
		esc_html( $messages[ $status ][1] )
	);
}

/**
 * Hidden fields + privacy consent shared by every form.
 *
 * @param string $type Form type.
 */
function nhh_form_common_fields( $type ) {
	?>
	<input type="hidden" name="action" value="nhh_contact">
	<input type="hidden" name="nhh_type" value="<?php echo esc_attr( $type ); ?>">
	<input type="hidden" name="redirect_to" value="<?php echo esc_url( get_permalink() ? get_permalink() : home_url( '/' ) ); ?>">
	<?php wp_nonce_field( 'nhh_contact', 'nhh_contact_nonce' ); ?>
	<div class="hp-field" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
	<?php
}

/**
 * Privacy consent checkbox.
 */
function nhh_form_privacy() {
	$privacy = get_privacy_policy_url();
	if ( ! $privacy ) {
		$privacy = nhh_page_url( 'privacy-policy' );
	}
	?>
	<div class="disclaimer">
		<label>
			<input type="checkbox" name="privacy" value="1" required>
			<span>
			<?php
			printf(
				/* translators: %s: privacy policy link */
				esc_html__( 'By submitting this form you agree to the terms of the %s.', 'northfield-home-health' ),
				'<a href="' . esc_url( $privacy ) . '">' . esc_html__( 'Privacy Policy', 'northfield-home-health' ) . '</a>'
			);
			?>
			</span>
		</label>
	</div>
	<?php
}

/**
 * Compact homepage form.
 *
 * @return string
 */
function nhh_contact_form() {
	ob_start();
	?>
	<form class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<?php echo nhh_form_notice( 'contact_short' ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside. ?>
		<?php nhh_form_common_fields( 'contact_short' ); ?>
		<div class="input_holder">
			<label class="screen-reader-text" for="nhh-name"><?php esc_html_e( 'Full Name', 'northfield-home-health' ); ?></label>
			<input id="nhh-name" type="text" name="full_name" placeholder="<?php esc_attr_e( '* Full Name', 'northfield-home-health' ); ?>" required>
			<label class="screen-reader-text" for="nhh-email"><?php esc_html_e( 'Email Address', 'northfield-home-health' ); ?></label>
			<input id="nhh-email" type="email" name="email" placeholder="<?php esc_attr_e( '* Email Address', 'northfield-home-health' ); ?>" required>
			<label class="screen-reader-text" for="nhh-message"><?php esc_html_e( 'Message', 'northfield-home-health' ); ?></label>
			<textarea id="nhh-message" name="message" rows="1" placeholder="<?php esc_attr_e( 'Message(s)', 'northfield-home-health' ); ?>"></textarea>
		</div>
		<?php nhh_form_privacy(); ?>
		<div class="btn_holder">
			<button type="submit" class="btn1 form_btn"><?php esc_html_e( 'Submit', 'northfield-home-health' ); ?> <?php nhh_the_icon( 'arrow' ); ?></button>
		</div>
	</form>
	<?php
	return ob_get_clean();
}
add_shortcode( 'nhh_contact_form', 'nhh_contact_form' );

/**
 * Render one field.
 *
 * @param string $type Form type (for unique ids).
 * @param string $key  Field key.
 * @param array  $f    Field definition.
 */
function nhh_render_field( $type, $key, $f ) {
	$id       = 'nhh-' . $type . '-' . $key;
	$required = ! empty( $f['required'] );
	$req_attr = $required ? ' required' : '';
	$classes  = 'nhh-field nhh-field--' . $f['type'] . ( ! empty( $f['wide'] ) || in_array( $f['type'], array( 'radio', 'checkboxes' ), true ) ? ' nhh-field--wide' : '' );
	$star     = $required ? ' <span class="req" aria-hidden="true">*</span>' : '';
	$ph       = isset( $f['placeholder'] ) ? ' placeholder="' . esc_attr( $f['placeholder'] ) . '"' : '';

	echo '<div class="' . esc_attr( $classes ) . '">';

	if ( in_array( $f['type'], array( 'radio', 'checkboxes' ), true ) ) {
		echo '<fieldset><legend>' . esc_html( $f['label'] ) . wp_kses_post( $star ) . '</legend><div class="nhh-choices">';
		foreach ( $f['options'] as $i => $opt ) {
			$input_type = 'radio' === $f['type'] ? 'radio' : 'checkbox';
			$name       = 'radio' === $f['type'] ? $key : $key . '[]';
			printf(
				'<label><input type="%1$s" name="%2$s" value="%3$s"%4$s> %5$s</label>',
				esc_attr( $input_type ),
				esc_attr( $name ),
				esc_attr( $opt ),
				( 'radio' === $f['type'] && $required && 0 === $i ) ? ' required' : '',
				esc_html( $opt )
			);
		}
		echo '</div></fieldset></div>';
		return;
	}

	echo '<label for="' . esc_attr( $id ) . '">' . esc_html( $f['label'] ) . wp_kses_post( $star ) . '</label>';

	switch ( $f['type'] ) {
		case 'textarea':
			echo '<textarea id="' . esc_attr( $id ) . '" name="' . esc_attr( $key ) . '" rows="5"' . $ph . $req_attr . '></textarea>'; // phpcs:ignore WordPress.Security.EscapeOutput -- attrs escaped above.
			break;
		case 'select':
			echo '<select id="' . esc_attr( $id ) . '" name="' . esc_attr( $key ) . '"' . $req_attr . '>'; // phpcs:ignore WordPress.Security.EscapeOutput
			echo '<option value="">' . esc_html__( '- Please select -', 'northfield-home-health' ) . '</option>';
			foreach ( $f['options'] as $opt ) {
				printf( '<option value="%1$s"%2$s>%1$s</option>', esc_attr( $opt ), selected( isset( $f['default'] ) ? $f['default'] : '', $opt, false ) );
			}
			echo '</select>';
			break;
		case 'file':
			echo '<input id="' . esc_attr( $id ) . '" type="file" name="' . esc_attr( $key ) . '" accept="' . esc_attr( isset( $f['accept'] ) ? $f['accept'] : '' ) . '"' . $req_attr . '>'; // phpcs:ignore WordPress.Security.EscapeOutput
			break;
		default:
			echo '<input id="' . esc_attr( $id ) . '" type="' . esc_attr( $f['type'] ) . '" name="' . esc_attr( $key ) . '"' . $ph . $req_attr . '>'; // phpcs:ignore WordPress.Security.EscapeOutput
	}
	echo '</div>';
}

/**
 * Full form shortcode: [nhh_form type="appointment"].
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function nhh_form_shortcode( $atts ) {
	$atts  = shortcode_atts( array( 'type' => 'contact' ), $atts, 'nhh_form' );
	$type  = sanitize_key( $atts['type'] );
	$forms = nhh_form_definitions();
	if ( ! isset( $forms[ $type ] ) || 'contact_short' === $type ) {
		return '';
	}
	$form = $forms[ $type ];

	ob_start();
	?>
	<form id="nhh-form" class="nhh-form nhh-form--<?php echo esc_attr( $type ); ?>" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"<?php echo ! empty( $form['multipart'] ) ? ' enctype="multipart/form-data"' : ''; ?>>
		<?php echo nhh_form_notice( $type ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside. ?>
		<?php nhh_form_common_fields( $type ); ?>
		<p class="nhh-form__required"><?php esc_html_e( 'Fields marked * are required.', 'northfield-home-health' ); ?></p>
		<?php
		$current = null;
		foreach ( $form['fields'] as $key => $field ) {
			$group = isset( $field['group'] ) ? $field['group'] : '';
			if ( $group !== $current ) {
				if ( null !== $current ) {
					echo '</div>';
				}
				if ( '' !== $group ) {
					echo '<h3 class="nhh-form__group">' . esc_html( $group ) . '</h3>';
				}
				echo '<div class="nhh-grid">';
				$current = $group;
			}
			nhh_render_field( $type, $key, $field );
		}
		if ( null !== $current ) {
			echo '</div>';
		}
		?>
		<?php nhh_form_privacy(); ?>
		<div class="btn_holder">
			<button type="submit" class="btn1 form_btn"><?php echo esc_html( isset( $form['submit'] ) ? $form['submit'] : __( 'Submit', 'northfield-home-health' ) ); ?> <?php nhh_the_icon( 'arrow' ); ?></button>
		</div>
	</form>
	<?php
	return ob_get_clean();
}
add_shortcode( 'nhh_form', 'nhh_form_shortcode' );

/**
 * Map shortcode: [nhh_map height="350"].
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function nhh_map_shortcode( $atts ) {
	$atts = shortcode_atts( array( 'height' => 350 ), $atts, 'nhh_map' );
	$src  = nhh_option( 'map_embed' );
	if ( ! $src ) {
		return '';
	}
	return sprintf(
		'<div class="nhh-map"><iframe src="%1$s" height="%2$d" title="%3$s" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe></div>',
		esc_url( $src ),
		absint( $atts['height'] ),
		esc_attr__( 'Map to our office', 'northfield-home-health' )
	);
}
add_shortcode( 'nhh_map', 'nhh_map_shortcode' );

/**
 * Handle submissions for every form type.
 */
function nhh_handle_contact() {
	$redirect = isset( $_POST['redirect_to'] ) ? esc_url_raw( wp_unslash( $_POST['redirect_to'] ) ) : home_url( '/' );
	$redirect = wp_validate_redirect( $redirect, home_url( '/' ) );
	$forms    = nhh_form_definitions();
	$type     = isset( $_POST['nhh_type'] ) ? sanitize_key( wp_unslash( $_POST['nhh_type'] ) ) : 'contact_short';
	if ( ! isset( $forms[ $type ] ) ) {
		$type = 'contact_short';
	}
	$anchor = 'contact_short' === $type ? '#contact' : '#nhh-form';
	$back   = function ( $status ) use ( $redirect, $type, $anchor ) {
		wp_safe_redirect( add_query_arg( array( 'nhh_contact' => $status, 'nhh_form' => $type ), $redirect ) . $anchor );
		exit;
	};

	if ( ! isset( $_POST['nhh_contact_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['nhh_contact_nonce'] ) ), 'nhh_contact' ) ) {
		$back( 'failed' );
	}

	// Honeypot: bots fill the hidden "website" field. Pretend success.
	if ( ! empty( $_POST['website'] ) ) {
		$back( 'sent' );
	}

	if ( empty( $_POST['privacy'] ) ) {
		$back( 'invalid' );
	}

	$lines       = array();
	$attachments = array();
	$reply_name  = '';
	$reply_email = '';

	foreach ( $forms[ $type ]['fields'] as $key => $f ) {
		$value = '';
		switch ( $f['type'] ) {
			case 'file':
				// phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- validated below.
				if ( ! empty( $_FILES[ $key ]['name'] ) ) {
					$file = $_FILES[ $key ]; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
					$ok   = wp_check_filetype_and_ext( $file['tmp_name'], $file['name'], array(
						'pdf'  => 'application/pdf',
						'doc'  => 'application/msword',
						'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
					) );
					if ( UPLOAD_ERR_OK !== $file['error'] || $file['size'] > 5 * MB_IN_BYTES || ! $ok['ext'] ) {
						$back( 'file' );
					}
					$tmp_dir = get_temp_dir() . 'nhh-' . wp_generate_password( 12, false );
					wp_mkdir_p( $tmp_dir );
					$dest = trailingslashit( $tmp_dir ) . sanitize_file_name( $file['name'] );
					if ( move_uploaded_file( $file['tmp_name'], $dest ) ) {
						$attachments[] = $dest;
						$value         = sanitize_file_name( $file['name'] ) . ' (attached)';
					}
				}
				break;
			case 'checkboxes':
				$raw   = isset( $_POST[ $key ] ) ? (array) wp_unslash( $_POST[ $key ] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
				$value = implode( ', ', array_intersect( array_map( 'sanitize_text_field', $raw ), $f['options'] ) );
				break;
			case 'textarea':
				$value = isset( $_POST[ $key ] ) ? sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) : '';
				break;
			case 'email':
				$value = isset( $_POST[ $key ] ) ? sanitize_email( wp_unslash( $_POST[ $key ] ) ) : '';
				if ( '' !== $value && ! is_email( $value ) ) {
					$back( 'invalid' );
				}
				break;
			default:
				$value = isset( $_POST[ $key ] ) ? sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) : '';
				if ( in_array( $f['type'], array( 'select', 'radio' ), true ) && '' !== $value && ! in_array( $value, $f['options'], true ) ) {
					$value = '';
				}
		}

		if ( ! empty( $f['required'] ) && '' === $value ) {
			$back( 'invalid' );
		}
		if ( 'full_name' === $key ) {
			$reply_name = $value;
		}
		if ( 'email' === $key ) {
			$reply_email = $value;
		}
		$lines[] = $f['label'] . ': ' . ( '' === $value ? '—' : $value );
	}

	$to = nhh_option( 'contact_to' );
	if ( ! is_email( $to ) ) {
		$to = nhh_option( 'email' );
	}
	if ( ! is_email( $to ) ) {
		$to = get_option( 'admin_email' );
	}

	/* translators: 1: form name, 2: sender name */
	$subject = sprintf( __( 'New %1$s from %2$s', 'northfield-home-health' ), strtolower( $forms[ $type ]['title'] ), $reply_name );
	$body    = implode( "\n", $lines ) . "\n\n— " . home_url( '/' ) . "\n";
	$headers = array();
	if ( $reply_email ) {
		$headers[] = 'Reply-To: ' . str_replace( array( "\r", "\n", '<', '>' ), '', $reply_name ) . ' <' . $reply_email . '>';
	}

	$sent = wp_mail( $to, $subject, $body, $headers, $attachments );

	foreach ( $attachments as $path ) {
		wp_delete_file( $path );
		@rmdir( dirname( $path ) ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
	}

	$back( $sent ? 'sent' : 'failed' );
}
add_action( 'admin_post_nhh_contact', 'nhh_handle_contact' );
add_action( 'admin_post_nopriv_nhh_contact', 'nhh_handle_contact' );
