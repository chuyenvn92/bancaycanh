<div class="row">
    <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
        <div class="p-b-30 m-lr-15-sm">
            <!-- Review -->
            <div id="paginate">
                @foreach ($comments as $comment)
                    <div class="flex-w flex-t p-b-68">
                        <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                            <img src="{{ asset('frontend/images/avatar-01.jpg') }}" alt="AVATAR">
                        </div>
                        <div class="size-207">
                            <div class="flex-w flex-sb-m p-b-17">
                                <span class="mtext-107 cl2 p-r-20">
                                    {{ $comment->user->name }}
                                </span>
                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                            </div>

                            <p class="stext-102 cl6">
                                {{ $comment->content }}
                            </p>
                        </div>
                    </div>
                @endforeach
    
                {{ $comments->links('vendor.pagination.paginate') }}
                
            </div>

            <!-- Add review -->
            <div class="p-t-40">
                <form class="w-full" method="POST">
                    @csrf
                    <h5 class="mtext-108 cl2 p-b-7">
                        Add a review
                    </h5>

                    <p class="stext-102 cl6">
                        Your email address will not be published. Required fields are marked *
                    </p>

                    <div class="row p-b-25">
                        <div class="col-12 p-b-5">
                            <label class="stext-102 cl3" for="review">Your review</label>
                            <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                        </div>
                    </div>

                    <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>