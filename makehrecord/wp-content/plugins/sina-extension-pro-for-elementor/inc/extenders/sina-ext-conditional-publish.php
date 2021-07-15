<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Plugin;

/**
 * Sina_Ext_Pro_Conditinal_Publish Class
 *
 * @since 1.4.0
 */
Class Sina_Ext_Pro_Conditinal_Publish{
	/**
	 * Instance
	 *
	 * @since 1.4.0
	 * @var Sina_Ext_Pro_Conditinal_Publish The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.4.0
	 * @return Sina_Ext_Pro_Conditinal_Publish An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'elementor/element/section/section_effects/after_section_end', [$this, 'register_controls'] );
		add_action( 'elementor/element/common/_section_border/after_section_end', [$this, 'register_controls'] );
		add_action( 'elementor/widget/render_content', [$this, 'render_content'], 10, 2 );
		add_action( 'elementor/frontend/section/should_render', [$this, 'render_content'], 10, 2 );
	}

	public function register_controls($elems) {

		$elems->start_controls_section(
			'sina_conditional_publish',
			[
				'label' => esc_html__('Sina Conditional Publish', 'sina-ext-pro'),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$elems->add_control(
			'sina_is_conditional_publish_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'NOTICE: Date and Time will calculate on UTC based.', 'sina-ext-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition' => [
					'sina_is_conditional_publish' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_is_conditional_publish',
			[
				'label' => esc_html__( 'Conditional Publish', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$elems->add_control(
			'sina_cp_relation',
			[
				'label' => esc_html__( 'Publish If', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' 	=> [
					'all' 	=> esc_html__( 'All Conditions have Filled', 'sina-ext-pro' ),
					'any' 	=> esc_html__( 'One Condition has Filled', 'sina-ext-pro' ),
				],
				'default' => 'all',
				'condition' => [
					'sina_is_conditional_publish' => 'yes',
				],
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'sina_cp_condition',
			[
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'Login Status' 	=> esc_html__( 'Login Status', 'sina-ext-pro' ),
					'The Day' => esc_html__( 'The Day(s)', 'sina-ext-pro' ),
					'The Month' => esc_html__( 'The Month(s)', 'sina-ext-pro' ),
					'The Date' => esc_html__( 'The Date', 'sina-ext-pro' ),
					'After The Date' => esc_html__( 'After The Date', 'sina-ext-pro' ),
					'The Date Range' => esc_html__( 'The Date Range', 'sina-ext-pro' ),
					'The Time Range' => esc_html__( 'The Time Range', 'sina-ext-pro' ),
				],
				'default' => 'Login Status',
			]
		);
		$repeater->add_control(
			'sina_cp_operator',
			[
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'is' => esc_html__( 'Is / Are', 'sina-ext-pro' ),
					'not' => esc_html__( 'Not', 'sina-ext-pro' ),
				],
				'default' => 'is',
			]
		);
		$repeater->add_control(
			'sina_cp_login_status',
			[
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'logged_in' => esc_html__( 'Logged In', 'sina-ext-pro' ),
				],
				'default' => 'logged_in',
				'condition' => [
					'sina_cp_condition' => 'Login Status',
				],
			]
		);
		$repeater->add_control(
			'sina_cp_the_day',
			[
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'options' => [
					'1' => esc_html__( 'Monday', 'sina-ext-pro' ),
					'2' => esc_html__( 'Tuesday', 'sina-ext-pro' ),
					'3' => esc_html__( 'Wednesday', 'sina-ext-pro' ),
					'4' => esc_html__( 'Thursday', 'sina-ext-pro' ),
					'5' => esc_html__( 'Friday', 'sina-ext-pro' ),
					'6' => esc_html__( 'Saturday', 'sina-ext-pro' ),
					'7' => esc_html__( 'Sunday', 'sina-ext-pro' ),
				],
				'multiple' => true,
				'default' => '1',
				'condition' => [
					'sina_cp_condition' => 'The Day',
				],
			]
		);
		$repeater->add_control(
			'sina_cp_the_month',
			[
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'options' => [
					'1' => esc_html__( 'January', 'sina-ext-pro' ),
					'2' => esc_html__( 'February', 'sina-ext-pro' ),
					'3' => esc_html__( 'March', 'sina-ext-pro' ),
					'4' => esc_html__( 'April', 'sina-ext-pro' ),
					'5' => esc_html__( 'May', 'sina-ext-pro' ),
					'6' => esc_html__( 'June', 'sina-ext-pro' ),
					'7' => esc_html__( 'July', 'sina-ext-pro' ),
					'8' => esc_html__( 'August', 'sina-ext-pro' ),
					'9' => esc_html__( 'September', 'sina-ext-pro' ),
					'10' => esc_html__( 'October', 'sina-ext-pro' ),
					'11' => esc_html__( 'November', 'sina-ext-pro' ),
					'12' => esc_html__( 'December', 'sina-ext-pro' ),
				],
				'multiple' => true,
				'default' => '1',
				'condition' => [
					'sina_cp_condition' => 'The Month',
				],
			]
		);
		$repeater->add_control(
			'sina_cp_the_date',
			[
				'type' => Controls_Manager::DATE_TIME,
				'label_block' => true,
				'picker_options' => [
					'format' => 'Ym/d',
					'enableTime' => false,
				],
				'default' => date( "Y/m/d", strtotime("+ 1 Day") ),
				'condition' => [
					'sina_cp_condition' => 'The Date',
				],
			]
		);
		$repeater->add_control(
			'sina_cp_after_the_date',
			[
				'type' => Controls_Manager::DATE_TIME,
				'label_block' => true,
				'picker_options' => [
					'format' => 'Ym/d',
					'enableTime' => false,
				],
				'default' => date( "Y/m/d", strtotime("+ 1 Day") ),
				'condition' => [
					'sina_cp_condition' => 'After The Date',
				],
			]
		);
		$repeater->add_control(
			'sina_cp_the_date_range',
			[
				'type' => Controls_Manager::DATE_TIME,
				'picker_options' => [
					'format' => 'Ym/d',
					'mode' => 'range',
					'enableTime' => false,
				],
				'default' => date( "Y/m/d", strtotime("+ 1 Day") ).' to '.date( "Y/m/d", strtotime("+ 3 Day") ),
				'condition' => [
					'sina_cp_condition' => 'The Date Range',
				],
			]
		);
		$repeater->add_control(
			'sina_cp_the_time_range_from',
			[
				'label' => esc_html__( 'From', 'sina-ext-pro' ),
				'type' => Controls_Manager::DATE_TIME,
				'label_block' => false,
				'picker_options' => [
					'format' => 'H:m:s',
					'noCalendar' => true,
				],
				'default' => date( "H:m:s", strtotime("+ 1 Hour") ),
				'condition' => [
					'sina_cp_condition' => 'The Time Range',
				],
			]
		);
		$repeater->add_control(
			'sina_cp_the_time_range_to',
			[
				'label' => esc_html__( 'To', 'sina-ext-pro' ),
				'type' => Controls_Manager::DATE_TIME,
				'label_block' => false,
				'picker_options' => [
					'format' => 'H:m:s',
					'noCalendar' => true,
				],
				'default' => date( "H:m:s", strtotime("+ 6 Hour") ),
				'condition' => [
					'sina_cp_condition' => 'The Time Range',
				],
			]
		);

		$elems->add_control(
			'sina_cp_conditions',
			[
				'label' => esc_html__( 'Conditions', 'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'sina_cp_condition' => 'Login Status',
						'sina_cp_operator' => 'is',
						'sina_cp_logged_in' => 'logged_in',
					],
				],
				'condition' => [
					'sina_is_conditional_publish' => 'yes',
				],
				'title_field' => '{{{ sina_cp_condition }}}',
			]
		);

		$elems->end_controls_section();
	}

	public function render_content($content, $elems) {
		$data = $elems->get_settings_for_display();

		if ( 'yes' == $data['sina_is_conditional_publish'] && !Plugin::$instance->editor->is_edit_mode() ) {
			$conditions = $data['sina_cp_conditions'];
			$conditions_count = count( $conditions );
			$i = 0;

			foreach ($conditions as $key => $condition) {
				$condition_name = str_replace(' ', '_', ( strtolower( $condition['sina_cp_condition'] ) ) );
				$check_operator	= $condition['sina_cp_operator'];
				$condition_value = [];
				$i++;

				if ( 'the_time_range' == $condition_name ) {
					$condition_value['from'] = $condition['sina_cp_the_time_range_from'];
					$condition_value['to'] = $condition['sina_cp_the_time_range_to'];
				} else {
					$condition_value = $condition['sina_cp_'. $condition_name];
				}

				if ( method_exists( $this, 'check_' .$condition_name ) ) {
					$check = call_user_func( [$this, 'check_'. $condition_name], $check_operator, $condition_value );

					if ( 'all' == $data['sina_cp_relation'] && !$check  ) {
						return;
					} elseif ( 'any' == $data['sina_cp_relation'] && $check ) {
						return $content;
					} elseif ( 'any' == $data['sina_cp_relation'] ) {
						if ( $conditions_count == $i ) {
							return;
						}
						continue;
					}
					continue;
				}
			}
		}

		return $content;
	}

	private function check_the_time_range($operator, $times) {
		$now = strtotime('now');
		$from = $this->check_date_time( $times['from'], 'H:i:s' );
		$to = $this->check_date_time( $times['to'], 'H:i:s' );

		return $this->check_date_time_range($operator, $from, $to);
	}

	private function check_the_date_range($operator, $dates) {
		$dates = explode(' to ', $dates);
		$date_pos1 = $this->check_date_time( $dates[0] );
		$date_pos2 = $this->check_date_time( $dates[1] );

		return $this->check_date_time_range($operator, $date_pos1, $date_pos2);
	}

	private function check_after_the_date($operator, $date) {
		$date_pos = $this->check_date_time( $date );
		if ( 'is' == $operator && 0 > $date_pos ) {
			return true;
		} elseif ( 'not' == $operator && 0 < $date_pos ) {
			return true;
		}
		return false;
	}

	private function check_the_date($operator, $date) {
		return $this->condition_check( $this->check_date_time( $date ), 0, $operator );
	}

	private function check_the_month($operator, $months) {
		if ( 'string' == gettype($months) ) {
			$months = [$months];
		}
		return $this->condition_check( in_array(date('n'), $months), true, $operator );
	}

	private function check_the_day($operator, $days) {
		if ( 'string' == gettype($days) ) {
			$days = [$days];
		}
		return $this->condition_check( in_array(date('N'), $days), true, $operator );
	}

	private function check_login_status($operator) {
		return $this->condition_check( is_user_logged_in(), true, $operator );
	}

	private function check_date_time_range( $operator, $from, $to ) {
		if ( 'is' == $operator && 0 >= $from && 0 <= $to ) {
			return true;
		} elseif ( 'not' == $operator && (0 < $from || 0 > $to) ) {
			return true;
		}
		return false;
	}

	private function check_date_time( $date, $format = 'Y-m-d' ) {
		$now = strtotime( date($format) );
		$date = strtotime($date);
		return ($date - $now);
	}

	private function condition_check( $first_value, $second_value, $operator ) {
		if ( 'is' == $operator ) {
			return ($first_value == $second_value);
		} elseif ( 'not' == $operator ) {
			return ($first_value != $second_value);
		}
		return ($first_value === $second_value);
	}
}

Sina_Ext_Pro_Conditinal_Publish::instance();