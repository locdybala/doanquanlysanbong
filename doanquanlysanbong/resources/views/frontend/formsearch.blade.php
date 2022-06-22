<div class="header__search-wrap">
    <form action="{{ route('search') }}" method="POST">
        @csrf
    <input type="text" class="header__search-input" name="keyword_submit" placeholder="Tìm kiếm">
    <button style="margin-left: 55px" type="submit" class="header__search-icon" >
        <i class="fas fa-search"></i>
    </button>
</div>