class PersonDetails {
    constructor() {
        this.id = new URLSearchParams(window.location.search).get('id');

        if (!this.id) {
            window.location.href = 'index.html';
            return;
        }

        this.init();
    }

    async init() {
        await this.loadDetails();
        this.initializeEventListeners();
    }

    async loadDetails() {
        try {
            // Fetch person details with combined credits
            const response = await fetch(
                `${config.baseUrl}/person/${this.id}?api_key=${config.apiKey}&append_to_response=combined_credits`
            );
            this.personData = await response.json();

            this.updateUI();
        } catch (error) {
            console.error('Error loading person details:', error);
            this.showError('Failed to load person details');
        }
    }

    initializeEventListeners() {
        // Initialize social share buttons
        document.getElementById('facebook-share').addEventListener('click', () => this.shareOnFacebook());
        document.getElementById('twitter-share').addEventListener('click', () => this.shareOnTwitter());
        document.getElementById('pinterest-share').addEventListener('click', () => this.shareOnPinterest());
        document.getElementById('whatsapp-share').addEventListener('click', () => this.shareOnWhatsApp());
    }

    updateUI() {
        document.querySelector('.loading-spinner').style.display = 'none';
        document.querySelector('.person-content').style.display = 'block';

        // Update basic info
        document.title = `${this.personData.name} - Movie Explorer`;
        document.querySelector('.name').textContent = this.personData.name;

        // Update profile image
        const profileImage = document.querySelector('.profile-image');
        profileImage.src = this.personData.profile_path
            ? `${config.imageBaseUrl}${this.personData.profile_path}`
            : 'placeholder-person.jpg';
        profileImage.alt = this.personData.name;

        // Update meta info
        if (this.personData.birthday) {
            const birthDate = new Date(this.personData.birthday);
            let age = '';
            if (!this.personData.deathday) {
                const today = new Date();
                age = today.getFullYear() - birthDate.getFullYear();
            }
            document.querySelector('.birth-date').textContent =
                `Born: ${birthDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                })}${age ? ` (${age} years old)` : ''}`;
        }

        if (this.personData.deathday) {
            const deathDate = new Date(this.personData.deathday)
            document.querySelector('.death-date').innerHTML = `<i class="fa fa-dove"></i> Demise: ${deathDate.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            })}`;
        }

        if (this.personData.place_of_birth) {
            document.querySelector('.birth-place').textContent =
                `Birth Place: ${this.personData.place_of_birth}`;
        }

        document.querySelector('.department').textContent =
            this.personData.known_for_department || '';

        // Update biography
        document.querySelector('.biography-text').textContent =
            this.personData.biography || 'No biography available';

        // Update known for section
        const knownForGrid = document.querySelector('.known-for-grid');
        const knownFor = this.personData.combined_credits.cast
            .sort((a, b) => {
                const dateA = new Date(a.release_date || a.first_air_date || '0000');
                const dateB = new Date(b.release_date || b.first_air_date || '0000');
                return dateB - dateA;
            })
            .slice(0, 36)
            .sort((a, b) => b.vote_average - a.vote_average)


        knownForGrid.innerHTML = knownFor.map(credit => `
            <div class="known-for-item">
                <a href="./details?id=${credit.id}&type=${credit.media_type}">
                    <img src="${credit.poster_path
                ? config.imageBaseUrl + credit.poster_path
                : 'placeholder-image.jpg'}" 
                        alt="${credit.title || credit.name}">
                    <div class="known-for-info">
                        <h4>${credit.title || credit.name}
                                <i class="fas fa-star"></i>
                                ${credit.vote_average.toFixed(1)}
                        </h4>
                        <p>${credit.character} </p>
                        <span>Year : ${this.getYear(credit.release_date || credit.first_air_date)}</span>
                    </div>
                </a>
            </div>
        `).join('');

        // Update filmography
        const filmographyList = document.querySelector('.filmography-list');
        const sortedCredits = this.personData.combined_credits.cast
            .sort((a, b) => {
                const dateA = new Date(a.release_date || a.first_air_date || '0000');
                const dateB = new Date(b.release_date || b.first_air_date || '0000');
                return dateB - dateA;
            });

        filmographyList.innerHTML = sortedCredits.map(credit => `
            <div class="filmography-item">
                <a href="./details?id=${credit.id}&type=${credit.media_type}">
                    <span class="year">${this.getYear(credit.release_date || credit.first_air_date)}</span>
                    <span class="title">${credit.title || credit.name}</span>
                    <span class="character">${credit.character || 'Unknown Role'}</span>
                </a>
            </div>
        `).join('');
    }

    getYear(dateString) {
        return dateString ? new Date(dateString).getFullYear() : 'TBA';
    }

    showError(message) {
        document.querySelector('.loading-spinner').style.display = 'none';
        const main = document.querySelector('main');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        main.appendChild(errorDiv);
    }

    shareOnFacebook() {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent(`${this.personData.biography}`);
        const description = encodeURIComponent(`${this.personData.biography}`);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${title} - ${description}`, '_blank');
    }

    shareOnTwitter() {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent(`${this.personData.name} - ${this.personData.biography}`);
        window.open(`https://twitter.com/intent/tweet?url=${url}&text=Check out "${title}" on BoxOffice`, '_blank');
    }

    shareOnPinterest() {
        const url = encodeURIComponent(window.location.href);
        const image = encodeURIComponent(`https://image.tmdb.org/t/p/w500${this.personData.profile_path}`);
        const description = encodeURIComponent(`${this.personData.name} - ${this.personData.biography}`);
        window.open(`https://pinterest.com/pin/create/button/?url=${url}&media=${image}&description=${description}`, '_blank');
    }

    shareOnWhatsApp() {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent(this.personData.name);
        const description = encodeURIComponent(this.personData.biography);
        window.open(`https://api.whatsapp.com/send?text=${title}%0A${description}%0A${url}`, '_blank');
    }
}

// Initialize the person details page
document.addEventListener('DOMContentLoaded', () => {
    new PersonDetails();
});
