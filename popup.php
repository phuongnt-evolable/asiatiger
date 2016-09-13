
  
  <link rel="stylesheet" href="css/example.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>

  <!-- This is what you need -->
  <script src="js/sweet-alert.min.js"></script>
  <link rel="stylesheet" href="css/sweet-alert.css">
  <!--.......................-->



<h1>Sweet Alert</h1>
<h2>A beautiful replacement for Javascript's "Alert"</h2>
<button class="download">Download</button>

<!-- What does it do? -->
<h3>So... What does it do?</h3>
<p>Here’s a comparison of a standard error message. The first one uses the built-in <strong>alert</strong>-function, while the second is using <strong>sweetAlert</strong>.</p>

<div class="showcase normal">
	<h4>Normal alert</h4>
	<button>Show error message</button>

	<h5>Code:</h5>
	<pre><span class="func">alert</span>(<span class="str">"Oops... Something went wrong!"</span>);

	</pre>

	<div class="vs-icon"></div>
</div>

<div class="showcase sweet">
	<h4>Sweet Alert</h4>
	<button>Show error message</button>

	<h5>Code:</h5>
	<pre>sweetAlert(<span class="str">"Oops..."</span>, <span class="str">"Something went wrong!"</span>, <span class="str">"error"</span>);</pre>
</div>

<p>Pretty cool huh? SweetAlert automatically centers itself on the page and looks great no matter if you're using a desktop computer, mobile or tablet. It's even highly customizeable, as you can see below!</p>



<script>

document.querySelector('button.download').onclick = function(){
	$("html, body").animate({ scrollTop: $("#download-section").offset().top }, 1000);
};

document.querySelector('.showcase.normal button').onclick = function(){
	alert("Oops... Something went wrong!");
};

document.querySelector('.showcase.sweet button').onclick = function(){
	swal("Oops...", "Something went wrong!", "error");
};

document.querySelector('ul.examples li.message button').onclick = function(){
	swal("Here's a message!");
};

document.querySelector('ul.examples li.timer button').onclick = function(){
	swal({
		title: "Auto close alert!",
		text: "I will close in 2 seconds.",
		timer: 2000,
		showConfirmButton: false
	});
};

document.querySelector('ul.examples li.title-text button').onclick = function(){
	swal("Here's a message!", "It's pretty, isn't it?");
};

document.querySelector('ul.examples li.success button').onclick = function(){
	swal("Good job!", "", "success");
};

document.querySelector('ul.examples li.warning.confirm button').onclick = function(){
	swal({
		title: "Are you sure?",
		text: "You will not be able to recover this imaginary file!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Yes, delete it!',
		closeOnConfirm: false
	},
	function(){
		swal("Deleted!", "Your imaginary file has been deleted!", "success");
	});
};

document.querySelector('ul.examples li.warning.cancel button').onclick = function(){
	swal({
		title: "Are you sure?",
		text: "You will not be able to recover this imaginary file!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Yes, delete it!',
		cancelButtonText: "No, cancel plx!",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
    if (isConfirm){
      swal("Deleted!", "Your imaginary file has been deleted!", "success");
    } else {
      swal("Cancelled", "Your imaginary file is safe :)", "error");
    }
	});
};

document.querySelector('ul.examples li.custom-icon button').onclick = function(){
	swal({
		title: "Sweet!",
		text: "Here's a custom image.",
		imageUrl: 'images/thumbs-up.jpg'
	});
};

document.querySelector('ul.examples li.message-html button').onclick = function(){
	swal({
		title: "HTML <small>Title</small>!",
		text: 'A custom <span style="color:#F8BB86">html<span> message.',
		html: true
	});
};

document.querySelector('ul.examples li.input button').onclick = function(){
	swal({
		title: "An input!",
		text: 'Write something interesting:',
		type: 'input',
		showCancelButton: true,
		closeOnConfirm: false,
		animation: "slide-from-top"
	}, 
	function(inputValue){
		if (inputValue === false) return false;

		if (inputValue === "") {
			swal.showInputError("You need to write something!");
			return false;
		}
		
		swal("Nice!", 'You wrote: ' + inputValue, "success");
		
	});
};

</script>


