<?php

    $allowed_specs = array('unknown', 'work');
    
    
    
?>
<html>
<head>
    <script type="text/javascript" src="http://info210.sexy-pants.com/js/jquery-1.6.4.min.js"></script>
    

      
      </head>
<body>
<label>
	<span>Keyword: <?php echo $spec; ?></span>
		<input type="text" name="keyword" value="" />
		<select>
		    <?php foreach ($allowed_specs as $spec) { ?>
		    <option value="<?php echo $spec; ?>" name="specification"><?php echo $spec; ?></option>
		    <?php } ?>
		    
		</select>
</label><br /><br />
<span id="add_field"> Add Field </span>
<script type="text/javascript">
      $(function(){
            //create a new field then append it before the add field button
            $("#add_field").click(function(){
                  var new_field = " <label>Name : </label> <input type = "text" / >";
                  new_field+="<label>Age : </label> <input type = "text" />";
                  $(this).before(new_field);
            });
      });</script>
</body>
</html>

