<?php

class Sidebar_Walker extends Walker_Nav_Menu {
	/**
	 * Display Element
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( isset( $args[0] ) && is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	 * Start Element
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( is_object( $args ) && ! empty( $args->has_children ) ) {
			$link_before       = $args->link_before;
			$icon              = get_field( 'иконка', $item );
			$args->link_before = ' <div class="icon"><img src="' . $icon['url'] . '" alt="' . $icon['alt'] . '"></div>';
		}
		parent::start_el( $output, $item, $depth, $args, $id );
		if ( is_object( $args ) && ! empty( $args->has_children ) ) {
			$args->link_before = $link_before;
		}
	}

	/**
	 * Start Level
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "", $depth );
		$output .= "\n$indent<ul class=\"dropdown\">\n";
	}
}
