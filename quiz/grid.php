<?php
    
    class grid
    {
        var $id_column = "id";
        var $page_name = "";
        var $grid_control_name ="div_grid";

        var $table = "<table border=1 class=tblGrid>";
        var $edit = true;
        var $edit_attr="";        
        var $delete = true;
        var $edit_text = "Edit";
        var $edit_link ="";
        var $delete_text = "Delete";
        var $checkbox = false;

        var $add_links = false;
        var $links ;
        var $id_links ;
        var $id_link_key="id";
        var $id_link_checks;
        var $commands;

        var $process_id = 0;

        var $message = 'Are you sure ?';

        var $_columns ;
        var $_headers;
        var $identity = "";
        var $selected_ids=array();

        var $process_command_override = "";
        var $edit_attr_override = "";
        var $edit_link_override = "";
        var $process_html_command="";
        var $empty_data_text="No records found";


        public function SetEdit($value)
        {
            $edit = $value;
        }

        public function SetDelete($value)
        {
            $delete = $value;
        }

        public function grid($headers, $columns, $page)
        {
            $this->_columns = $columns;
            $this->_headers = $headers;
            $this->page_name= $page;
            $this->table.="<tr class=c_list_head>";
            foreach($headers as $header)
            {
                $this->table.="<td>&nbsp;".$header."</td>";
            }
            $this->table.="</tr>";
        }

        public function DrowTable($query)
        {            
          //  db::connect();
            $rows = db::exec_sql($query);
            $found = false;
            //$r_count=db::num_fields($rows);
            while($row=db::fetch($rows))
            {                
                $this->table.="<tr class=c_list_item>";
                $this->AddCheckbox($row);
                foreach($this->_columns as $key=>$value)
                {
                    $this->table.="<td>&nbsp;".trim(strip_tags($this->FormatColumn($value,$row[$key])))."&nbsp;</td>";
                }
                $this->AddLinks();
                $this->AddIdLinks($row);
                $this->ProcessCommands($row);
                $this->ProcessHTML($row);
                $this->ProcessEdit($row);
                $this->ProcessDelete($row);
               $this->table.="</tr>";
               $found = true;
            }

            if(!$found)
            {
                $this->table.="<tr><td class=empty_data colspan=".count($this->_headers).">&nbsp;".$this->empty_data_text."</td></tr>";
            }

            $this->table.="</table>";
            $this->DrowJs();
          //  db::close_connection();

        }

        private function FormatColumn($format , $results)
        {
            if($format=="short date")
            {                
                $results = date('F d, Y ', strtotime($results));
            }
            return $results;
        }

        public function IsClickedBtnDelete()
        {
            if(isset($_POST["hdnEventMode"]) && $_POST["hdnEventMode"]=="delete")
            {
                $this->process_id=intval($_POST["hdnEventArgs"]);
                return true;
            }
            return false;
        }

        public function IsClickedBtnEdit()
        {
            if(isset($_POST["hdnEventMode"]) && $_POST["hdnEventMode"]=="edit")
            {
                $this->process_id=intval($_POST["hdnEventArgs"]);
                return true;
            }
            return false;
        }

        public function IsClickedBtn($btn)
        {
            if(isset($_POST["hdnEventMode"]) && $_POST["hdnEventMode"]==$btn)
            {
                $this->process_id=intval($_POST["hdnEventArgs"]);
                return true;
            }
            return false;
        }

        public function DrowJs()
        {
            $this->table.="<input type=hidden id=hdnEventArgs /><input type=hidden id=hdnEventMode />";
        }

        private function ProcessEdit($row)
        {
            if(!$this->edit) return ;

            $edit_attr= $this->edit_attr;
            $edit_attr_override = $this->edit_attr_override;
            $edit_link_override = $this->edit_link_override;

            if($edit_attr_override!="")
            {
                $edit_attr=$edit_attr_override($row);
            }

            $edit_link = "<a $edit_attr href='".$this->edit_link."&id=".$row[$this->id_column]."'>$this->edit_text</a>";

            if($edit_link_override!="")
            {                 
                $edit_link=$edit_link_override($row);
            }            

            $this->table.="<td>&nbsp;$edit_link</td>";

        }

        public static function EditCommandTemplate($row,$grd)
        {
            $html = "&nbsp;<a href='".$grd->edit_link."&id=".$row[$grd->id_column]."'>$grd->edit_text</a>";
            return $html;
        }

        private function ProcessDelete($row)
        {
            if(!$this->delete) return ;

            $id = $this->id_column;
            $this->table.="<td>&nbsp;<a href='javascript:jsProcessDelete(\"$this->message\",$row[$id], \"$this->page_name\", \"$this->grid_control_name\" )'>$this->delete_text</a></td>";

        }

        public static function ProcessCommandTemplate($row,$value,$key,$grd)
        {
            $html = "<td>&nbsp;<a href='javascript:jsProcessCommand(".$row[$grd->id_column].", \"$grd->page_name\", \"$grd->grid_control_name\", \"$value\" )'>$key</a></td>";
            return $html;
        }

        private function ProcessHTML($row)
        {
            if($this->process_html_command=="") return ;

            $process_html_command = $this->process_html_command;
            $this->table.=$process_html_command($row);

        }
      
        private function ProcessCommands($row)
        {
            if(count($this->commands)==0) return ;

            $process_command_override = $this->process_command_override;
            //$process_command_override();

            $id = $this->id_column;
            foreach($this->commands as $key=>$value)
            {
                 if($process_command_override!="")
                 {
                     $this->table.=$process_command_override($row);
                 }
                 else
                 {
                     $this->table.="<td><a href='javascript:jsProcessCommand($row[$id], \"$this->page_name\", \"$this->grid_control_name\", \"$value\" )'>$key</a></td>";
                 }
            }
        }

        private function AddCheckbox($row)
        {
            if(!$this->checkbox) return ;

            $checked = "";
            if(in_array($row[$this->id_column], $this->selected_ids, true))
            {
                $checked="checked";
            }

            $identity =$this->identity;
            $this->table.="<td><input $checked type=checkbox name=chkgrd".$identity."[] value=".$row[$this->id_column]." /></td>";
        }
        
        private function AddLinks()
        {
            if(count($this->links)==0) return ;

            foreach($this->links as $key=>$value)
            {
                 $this->table.="<td>&nbsp;<a href='$value'>$key</a></td>";
            }
        }

        private function AddIdLinks($row)
        {
            if(count($this->id_links)==0) return ;
            if($row[$this->id_column]=="")
            {
                    $this->table.="<td>&nbsp;</td>";
                    return;
            }

            foreach($this->id_links as $key=>$value)
            {
                 $this->table.="<td>&nbsp;<a href='$value&".$this->id_link_key."=".$row[$this->id_column]."'>$key</a></td>";
            }
        }

    }

?>