const button = document.getElementById('complete-lesson');

async function completeLesson() {
    if (!button || button.disabled) return;
    button.disabled = true;
    const response = await fetch(button.dataset.url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify({ completed: true }),
    });
    if (!response.ok) { button.disabled = false; return; }
    const data = await response.json();
    button.textContent = data.course_completed ? 'Đã hoàn thành khóa học ✓' : `Đã hoàn thành · ${data.progress}%`;
}

button?.addEventListener('click', completeLesson);
document.getElementById('lesson-video')?.addEventListener('ended', completeLesson);

if (document.getElementById('youtube-player')) {
    const tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    document.head.appendChild(tag);
    window.onYouTubeIframeAPIReady = () => new window.YT.Player('youtube-player', { events: { onStateChange: event => { if (event.data === window.YT.PlayerState.ENDED) completeLesson(); } } });
}
