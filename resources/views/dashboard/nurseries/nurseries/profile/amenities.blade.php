 <style>
        body {font-family: Arial, Helvetica, sans-serif;}

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)}
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  left: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}
li
{
   list
}
/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
.list{
    list-style: none;
	background-image: url("/admin/img/svg/icons8-baby-%20logoutfootprint.svg");
	background-repeat: no-repeat;
	background-position: 93%  center;
	background-size: 40px;
     font-size: 20px;
}
</style>
<div id="amenities" class="container tab-pane"><br>
    <ul class="row amenties-list">
        @foreach($data['amenities'] as $amenity)

            <li class="col-md-4 list">
            @if($amenity->getImages())

                @foreach($amenity->getImages() as $image)

                        <div class="card card-plain card-blog mt-4">
                                              <h5 class="mt-4"> {{ ($amenity->amenity) ? $amenity->amenity->name : '' }}</h5>

                            <div class="card-image border-radius-lg position-relative">
                                <a href="javascript:;">
                                    <div class="blur-shadow-image">

                                        <img id="myImg" width="250" height="200" class="img img-fluid border-radius-lg move-on-hover" src="{{ $image->image_path }}">

                                    </div>
                                </a>
                                       <div id="myModal" class="modal">
  <span class="close">×</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
                            </div>
                        </div>


                @endforeach

            @endif
            </li>

        @endforeach
    </ul>


<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>
    @if(isset($inspect) and $inspect)
        @php
            $c = 'amenity';
            $next = 'utilities';
            $prev = 'baby_sitter';
        @endphp
        @include('dashboard.nurseries.inspections.partials._evaluate')
    @endif
</div>
