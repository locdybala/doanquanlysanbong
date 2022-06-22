
<ul class="header__nav-list">
    <li class="header__nav-item index">
        <a href="{{ route('home') }}" class="header__nav-link">Trang chủ</a>
    </li>
    <li class="header__nav-item">
        <a href="#" class="header__nav-link">Giới Thiệu</a>
    </li>
    <li class="header__nav-item">
        <a href="#" class="header__nav-link">Sân Bóng</a>
        <div class="sub-nav-wrap grid wide">
            <ul class="sub-nav">
            </ul>
            <ul class="sub-nav">
                
            </ul>
            <ul style="margin-left:140px" class="sub-nav">
                <li class="sub-nav__item">
                    <a href="" class="sub-nav__link heading">Sân 5</a>
                </li>
              
            </ul>

        </div>
    </li>
    <li class="header__nav-item">
        <a href="#" class="header__nav-link">Tin Tức</a>
        <div class="sub-nav-wrap grid wide">
            <ul class="sub-nav">
            </ul>
            <ul class="sub-nav">
                
            </ul><ul class="sub-nav">
            </ul>
            <ul style="margin-left:120px" class="sub-nav">
                @foreach ($postcategory as $category)
                    
                
                <li class="sub-nav__item">
                    <a href="{{ route('danhmucbaiviet',['slug'=>$category->slug]) }}" class="sub-nav__link heading">{{ $category->name }}</a>
                </li>
                @endforeach
            </ul>

        </div>
    </li>
    <li class="header__nav-item">
        <a href="{{ route('contact') }}" class="header__nav-link">Liên Hệ</a>
    </li>
</ul>
