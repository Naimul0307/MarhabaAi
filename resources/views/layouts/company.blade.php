<!-- Start Company Slider -->
<section class="partners-section">
    <h2 class="hidden">Partners</h2>

    <div class="container">
        <div class="row">
            <div class="col col-xs-12">

                <div class="partners-slider">

                    @foreach($companies as $company)

                        @if(!empty($company->image))
                            <div class="grid">
                                <img
                                    src="{{ asset('uploads/companies/thumb/large/' . $company->image) }}"
                                    alt="{{ $company->name }}"
                                    class="img img-responsive"
                                >
                            </div>
                        @endif

                    @endforeach

                </div>

            </div>
        </div>
    </div>
</section>
<!-- End Company Slider -->
