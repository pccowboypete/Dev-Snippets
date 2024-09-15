<?php

if (have_rows('acf_repeater_field', get_the_ID())) {

    while (have_rows('acf_repeater_field', get_the_ID())) {
        the_row();

        //get_sub_field('subfield_key')
    }
}
