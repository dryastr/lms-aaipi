function shareFacebook(slug) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/blog/' + slug + '/share/facebook', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ slug: slug })
    }).then(response => {
        console.log('Successfully shared on Facebook!');
    }).catch(error => {
        console.error('Error sharing on Facebook:', error);
    });
}

function shareTwitter(slug) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/blog/' + slug + '/share/twitter', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ slug: slug })
    }).then(response => {
        console.log('Successfully shared on Twitter!');
    }).catch(error => {
        console.error('Error sharing on Twitter:', error);
    });
}

function shareLinkedin(slug) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/blog/' + slug + '/share/linkedin', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ slug: slug })
    }).then(response => {
        console.log('Successfully shared on LinkedIn!');
    }).catch(error => {
        console.error('Error sharing on LinkedIn:', error);
    });
}
