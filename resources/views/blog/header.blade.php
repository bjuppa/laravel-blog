<header>
<h1>{{ $blog->getTitle() }}</h1>
@includeFirst(['blog::blog.intro-'.$blog->getId(), 'blog::blog.intro'])
</header>
