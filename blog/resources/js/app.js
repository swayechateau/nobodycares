import './bootstrap';

document.getElementById('search-input').addEventListener('input', function(e) {
    const query = e.target.value.toLowerCase();
    const posts = document.querySelectorAll('#posts-list article');
    
    posts.forEach(post => {
        const title = post.querySelector('h2').textContent.toLowerCase();
        if (title.includes(query)) {
            post.style.display = 'block';
        } else {
            post.style.display = 'none';
        }
    });
});
