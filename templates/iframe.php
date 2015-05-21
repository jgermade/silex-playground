<?php $this->layout('base-layout', ['title' => 'Email']) ?>

<h4 id="iframe-wrapper" style="text-align: center;">
	<iframe id="iframe-element" src="//playground.germade.es/iframe-content" style="width: 800px; height: 640px;"></iframe>
</h4>
<script type="text/javascript" >
	function receiveMessage(event){
		var result = event.data && event.data.result;
	
		if( result ){
			$('#iframe-wrapper').html('Result: <strong>' + result + '</strong>');
		}
	}
	window.addEventListener("message", receiveMessage, false);
</script>