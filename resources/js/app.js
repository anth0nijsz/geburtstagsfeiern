import './bootstrap';

const nameScreen = document.querySelector('#nameScreen');
const cardStage = document.querySelector('#cardStage');
const nameForm = document.querySelector('#nameForm');
const guestName = document.querySelector('#guestName');
const guestDisplay = document.querySelector('#guestDisplay');
const card = document.querySelector('#inviteCard');
const flipButton = document.querySelector('#flipButton');
const backButton = document.querySelector('#backButton');
const messageForm = document.querySelector('#messageForm');
const messageStatus = document.querySelector('#messageStatus');

const launchConfetti = () => {
	const canvas = document.querySelector('#confetti');
	const context = canvas.getContext('2d');
	const pieces = [];
	const colors = ['#b9826c', '#aeb9a7', '#ddd7cd', '#292824', '#f5f2ec'];
	canvas.width = window.innerWidth;
	canvas.height = window.innerHeight;
	for (let index = 0; index < 130; index += 1) {
		pieces.push({ x: Math.random() * canvas.width, y: -20 - Math.random() * 200, size: 5 + Math.random() * 7, speed: 3 + Math.random() * 4, drift: -2 + Math.random() * 4, rotation: Math.random() * 6, color: colors[index % colors.length] });
	}
	const animate = () => {
		context.clearRect(0, 0, canvas.width, canvas.height);
		pieces.forEach((piece) => {
			piece.y += piece.speed; piece.x += piece.drift; piece.rotation += .08;
			context.save(); context.translate(piece.x, piece.y); context.rotate(piece.rotation); context.fillStyle = piece.color; context.fillRect(-piece.size / 2, -piece.size / 2, piece.size, piece.size * .55); context.restore();
		});
		if (pieces.some((piece) => piece.y < canvas.height + 20)) requestAnimationFrame(animate);
	};
	animate();
};

nameForm?.addEventListener('submit', (event) => {
	event.preventDefault();
	const name = guestName.value.trim();
	if (!name) return;
	guestDisplay.textContent = name;
	nameScreen.classList.add('is-hidden'); cardStage.classList.remove('is-hidden'); launchConfetti(); window.scrollTo({ top: 0, behavior: 'smooth' });
});
flipButton?.addEventListener('click', () => card.classList.toggle('is-flipped'));
card?.addEventListener('click', () => card.classList.toggle('is-flipped'));
backButton?.addEventListener('click', () => { cardStage.classList.add('is-hidden'); nameScreen.classList.remove('is-hidden'); guestName.focus(); });

messageForm?.addEventListener('submit', async (event) => {
	event.preventDefault();
	const submitButton = messageForm.querySelector('button'); submitButton.disabled = true; messageStatus.textContent = 'Your message is being sent ...';
	try {
		const response = await fetch('/birthday-messages', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, Accept: 'application/json' }, body: new FormData(messageForm) });
		const data = await response.json(); if (!response.ok) throw new Error(data.message || 'Could not send your note.');
		messageForm.reset(); messageStatus.textContent = data.message;
	} catch (error) { messageStatus.textContent = error.message || 'Your message could not be sent.'; } finally { submitButton.disabled = false; }
});
