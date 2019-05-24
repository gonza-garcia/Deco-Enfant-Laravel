<!-- SCRIPTS DE JAVA DE BOOTSTRAP---------------------------------->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script type="text/javascript">
    $(document).ready(function(){
    	// Activate tooltip
    	$('[data-toggle="tooltip"]').tooltip();

    	// Select/Deselect checkboxes
    	var checkbox = $('table tbody input[type="checkbox"]');
    	$("#selectAll").click(function(){
    		if(this.checked){
    			checkbox.each(function(){
    				this.checked = true;
    			});
    		} else{
    			checkbox.each(function(){
    				this.checked = false;
    			});
    		}
    	});
    	checkbox.click(function(){
    		if(!this.checked){
    			$("#selectAll").prop("checked", false);
    		}
    	});
    });
</script>
