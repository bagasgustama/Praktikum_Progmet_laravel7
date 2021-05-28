<style>.categories{margin-top: 0px !important;}</style>


  <div class="categories animated wow slideInUp" data-wow-delay=".5s">
      <h3>Categories</h3>
      <ul class="cate">
        @foreach ($data_kategori as $listkategori)
        <li class="active">
            <li><a href="/kategori/{{ $listkategori->id }}">{{ $listkategori->category_name }}</a></li>
        </li>
        @endforeach
      </ul>
  </div>
