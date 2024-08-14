@extends('layouts.master')

@section('frontend_content')


 <!--section-heading-->
 <div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>Contact us</h1>
                         <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> pages</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>

<!--contact-->
<section class="contact">
    <div class="container-fluid">
        <div class="contact-area">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-image">
                        <img src="{{ asset('dashboard_asset/assets/images/backgrounds/sign-in.svg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-info">
                        <h3>feel free to contact us</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate deserunt suscipit error deleniti
                            porro, pariatur voluptatem iste quos maxime aspernatur.</p>
                    </div>
                    <!--form-->


                    <form action="{{ route('contact.post') }}" class="form" method="POST" id="main_contact_form">
                        @csrf
                        <div class="alert alert-success contact_msg" style="display: none" role="alert">
                            Your message was sent successfully.
                        </div>
                        <div class="form-group">
                            <input type="name" name="name" id="name" class="form-control" placeholder="Name*" required="required">
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email*" >
                        </div>

                        <div class="form-group">
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject*" >
                        </div>

                        <div class="form-group">
                            <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Message*" ></textarea>
                        </div>

                        <button type="submit" name="submit" class="btn-custom">Send Message</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</section>


@endsection


@section('footer_content')


@if (session('success'))

<script>
    const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: "success",
  background: 'blue',
  title: "{{ session('success') }}",
});

</script>

@endif

@endsection
