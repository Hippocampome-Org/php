<script language="javascript">
	var selected_row=0;
	var old_selected_row=0;
	var border_change=0;
	var old_border_change=0;
	function changerowcolor(curRow)
	{
		old_selected_row = selected_row;
		selected_row=curRow;
		var row_color_change = 'main_table_row_'+selected_row;
		var old_row_color_change = 'main_table_row_'+old_selected_row;
		/* change row highlight */
		document.getElementById(row_color_change).style.backgroundImage='';    
		document.getElementById(row_color_change).style.backgroundColor='#ffeb94';
		/* change old row highlight back */
		document.getElementById(old_row_color_change).style.backgroundImage='';    
		document.getElementById(old_row_color_change).style.backgroundColor='#FFFFFF';
	}
	function changebordercolor(curRow)
	{
		old_border_change = border_change;
		border_change=curRow;
		var row_border_change = 'main_table_row_'+border_change;
		var old_row_border_change = 'main_table_row_'+old_border_change;
		/* change row border */
		if (border_change != selected_row) {
			document.getElementById(row_border_change).style.backgroundImage='linear-gradient(white 0%, white 94%, lightgreen 100%)'; 
			document.getElementById(row_border_change).style.backgroundImage='-moz-linear-gradient(white 0%, white 85%, lightgreen 100%)'; 
			document.getElementById(row_border_change).style.backgroundImage='-webkit-linear-gradient(white 0%, white 94%, lightgreen 100%)';
			document.getElementById(row_border_change).style.backgroundImage='-ms-linear-gradient(white 0%, white 85%, lightgreen 100%)';
			document.getElementById(row_border_change).style.backgroundImage='-o-linear-gradient(white 0%, white 85%, lightgreen 100%)';
		}
		/* change old row border back */
		if (old_border_change != selected_row) {
			document.getElementById(old_row_border_change).style.backgroundImage='';    
			document.getElementById(old_row_border_change).style.backgroundColor='white';
		}
	}
	function changebordercolor2(curRow)
	{
		old_border_change = border_change;
		border_change=curRow;
		var row_border_change = 'main_table_row_'+border_change;
		var old_row_border_change = 'main_table_row_'+old_border_change;
		/* change row border */
		if (border_change != selected_row) {
			document.getElementById(row_border_change).style.backgroundImage='linear-gradient(white 0%, white 94%, red 100%)'; 
			document.getElementById(row_border_change).style.backgroundImage='-moz-linear-gradient(white 0%, white 85%, red 100%)'; 
			document.getElementById(row_border_change).style.backgroundImage='-webkit-linear-gradient(white 0%, white 94%, red 100%)';
			document.getElementById(row_border_change).style.backgroundImage='-ms-linear-gradient(white 0%, white 85%, red 100%)';
			document.getElementById(row_border_change).style.backgroundImage='-o-linear-gradient(white 0%, white 85%, red 100%)';
		}
		/* change old row border back */
		/*if (old_border_change != selected_row) {
			document.getElementById(old_row_border_change).style.backgroundImage='';    
			document.getElementById(old_row_border_change).style.backgroundColor='white';
		}*/
	}	
</script>