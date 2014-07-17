<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Memberlist Class
 *
 * @package     ExpressionEngine
 * @category        Plugin
 * @author      Gianfranco Montoya 
 * @copyright       Copyright (c) 2014, Gianfranco Montoya
 * @link        http://www.ayuinc.com/
 */

$plugin_info = array(
    'pi_name'         => 'Filtros',
    'pi_version'      => '1.0',
    'pi_author'       => 'Gianfranco Montoya',
    'pi_author_url'   => 'http://www.ayuinc.com/',
    'pi_description'  => 'Allows states qualify Friends',
    'pi_usage'        => Filtros::usage()
);
            
class Filtros 
{

    var $return_data = "";
    // --------------------------------------------------------------------

        /**
         * Memberlist
         *
         * This function returns a list of members
         *
         * @access  public
         * @return  string
         */
    public function __construct(){
        $this->EE =& get_instance();
        $var = $this->EE->input->post('count');
    }

    // --------------------------------------------------------------------

    /**
     * Usage
     *
     * This function describes how the plugin is used.
     *
     * @access  public
     * @return  string
     */
    public static function usage()
    {
        ob_start();  ?>
        The Memberlist Plugin simply outputs a
        list of 15 members of your site.

            {exp:filtros}

        This is an incredibly simple Plugin.
            <?php
        $buffer = ob_get_contents();
        ob_end_clean();
        return $buffer;
    }
    // END
    
    public function region(){
        $form = '<select name="region" id="region"> <option value="REGION" selected>DEPARTAMENTO</option>';
        ee()->db->distinct('departamento');
        ee()->db->select('departamento');
        $query = ee()->db->get('exp_agencias');
        foreach($query->result() as $row){
            $aux=$row->departamento;
            $aux= str_replace(" ", "-",$aux);
            $form .= '<option value='.$aux.'>'.$row->departamento.'</option>';
        }
        $form = $form.'</select>';
        return $form;

    }

    public function district(){
        $form = '<option value="DISTRITO" selected>CIUDAD/DISTRITO</option>';
        $region = ee()->TMPL->fetch_param('region');
        ee()->db->distinct('distrito');
        ee()->db->select('distrito');
        ee()->db->where('departamento',$region);
        $query = ee()->db->get('exp_agencias');
        foreach($query->result() as $row){
            $aux=$row->distrito;
            $aux= str_replace(" ", "-",$aux);
            $form .= '<option value='.$aux.'>'.$row->distrito.'</option>';
        }
        return $form;

    }

    public function agency(){
        $div = '';
        $district = ee()->TMPL->fetch_param('distrito');
        ee()->db->select('*');
        ee()->db->where('distrito',$district);
        $query = ee()->db->get('exp_agencias');
        foreach($query->result() as $row){
            $div .='<div class="result">';
            $div .= '<p>'.$row->oficina.'</p>';
            $div .= '<p>'.$row->direccion.'</p>';
            $div .= '<p>'.$row->ubicacion.'</p>';
            $div .= '</div>';
        }
        return $div;


    }
} 
/* End of file pi.rating.php */
/* Location: ./system/expressionengine/third_party/rating/pi.rating.php */