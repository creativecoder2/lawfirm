<style>
    :root {
        --primary-gold: #d0a15e;
        --dark-bg: #1a1a1a;
        --glass-bg: rgba(255, 255, 255, 0.05);
        --glass-border: rgba(255, 255, 255, 0.1);
    }

    .landmark-page {
        background-color: #f8f9fa;
        padding-bottom: 100px;
    }

    .search-section {
        background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 100%);
        padding: 80px 0;
        margin-bottom: 50px;
        position: relative;
        overflow: hidden;
    }

    .search-section::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 300px;
        height: 300px;
        background: var(--primary-gold);
        filter: blur(150px);
        opacity: 0.1;
        border-radius: 50%;
    }

    .search-container {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .premium-search {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        padding: 5px 30px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .premium-search:focus-within {
        border-color: var(--primary-gold);
        box-shadow: 0 0 20px rgba(208, 161, 94, 0.2);
    }

    .premium-search input {
        background: transparent;
        border: none;
        color: #fff;
        padding: 15px 0;
        font-size: 1.1rem;
        width: 100%;
        outline: none !important;
    }

    .premium-search input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .premium-search i {
        color: var(--primary-gold);
        font-size: 1.2rem;
        margin-right: 15px;
    }

    .alphabet-nav {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-bottom: 40px;
    }

    .letter-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #fff;
        border: 1px solid #eee;
        color: #666;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none !important;
    }

    .letter-btn:hover, .letter-btn.active {
        background: var(--primary-gold);
        color: #fff;
        border-color: var(--primary-gold);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(208, 161, 94, 0.3);
    }

    .landmark-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
    }

    .letter-header {
        grid-column: 1 / -1;
        font-size: 2.5rem;
        font-weight: 800;
        color: #eee;
        margin-top: 40px;
        margin-bottom: 20px;
        border-bottom: 2px solid #eee;
        display: flex;
        align-items: center;
    }

    .letter-header span {
        background: var(--primary-gold);
        color: #fff;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-right: 20px;
        font-size: 1.5rem;
    }

    .landmark-card {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        border: 1px solid #eee;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 180px;
        position: relative;
        overflow: hidden;
        text-decoration: none !important;
        color: inherit !important;
    }

    .landmark-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border-color: var(--primary-gold);
    }

    .landmark-card i {
        font-size: 2.5rem;
        color: #f44336;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .landmark-card:hover i {
        transform: scale(1.1);
    }

    .landmark-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #333;
        line-height: 1.4;
        margin-bottom: 10px;
    }

    .download-badge {
        font-size: 0.8rem;
        color: var(--primary-gold);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
    }

    .download-badge i {
        font-size: 1rem;
        margin-bottom: 0;
        margin-right: 5px;
        color: var(--primary-gold);
    }

    mark {
        background: rgba(208, 161, 94, 0.3);
        color: inherit;
        padding: 0;
    }

    @media (max-width: 768px) {
        .landmark-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="landmark-page">
   

    <div class="search-section">
        <div class="container">
            <div class="search-container text-center">
                <h3 class="text-white mb-4">Find Legal Documents and Cases</h3>
                <div class="premium-search">
                    <i class="fa fa-search"></i>
                    <input type="text" id="case-search" placeholder="Search by case name or keywords...">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Alphabet Navigation -->
        <div class="alphabet-nav">
            <?php 
            $letters = range('A', 'Z');
            foreach($letters as $letter): ?>
                <a href="#letter-<?= $letter ?>" class="letter-btn" onclick="scrollToLetter(event, '<?= $letter ?>')"><?= $letter ?></a>
            <?php endforeach; ?>
        </div>

        <div class="landmark-container" id="landmarks-list">
            <?php 
            if(!empty($landmarks)): 
                $current_letter = '';
                foreach($landmarks as $row): 
                    $first_letter = strtoupper(substr($row['title'], 0, 1));
                    if($first_letter !== $current_letter):
                        $current_letter = $first_letter;
                        ?>
                        <div class="letter-header" id="letter-<?= $current_letter ?>" data-letter="<?= $current_letter ?>">
                            <span><?= $current_letter ?></span>
                            <?= $current_letter ?> Cases
                        </div>
                    <?php endif; ?>
                    
                    <a href="<?= base_url($row['pdf']) ?>" target="_blank" class="landmark-card" data-title="<?= strtolower($row['title']) ?>">
                        <div>
                            <i class="fa fa-file-pdf-o"></i>
                            <div class="landmark-title"><?= $row['title'] ?></div>
                        </div>
                        <div class="download-badge">
                            <i class="fa fa-download"></i> Download PDF
                        </div>
                    </a>
                <?php endforeach; 
            else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fa fa-folder-open-o fa-4x text-muted mb-3"></i>
                    <h4>No landmark cases found.</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function scrollToLetter(e, letter) {
    e.preventDefault();
    const target = document.getElementById('letter-' + letter);
    if (target) {
        const offset = 100;
        const bodyRect = document.body.getBoundingClientRect().top;
        const elementRect = target.getBoundingClientRect().top;
        const elementPosition = elementRect - bodyRect;
        const offsetPosition = elementPosition - offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });

        // Update active class
        document.querySelectorAll('.letter-btn').forEach(btn => btn.classList.remove('active'));
        e.target.classList.add('active');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('case-search');
    const cards = document.querySelectorAll('.landmark-card');
    const headers = document.querySelectorAll('.letter-header');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        
        cards.forEach(card => {
            const title = card.getAttribute('data-title');
            const titleEl = card.querySelector('.landmark-title');
            const originalText = titleEl.getAttribute('data-original') || titleEl.textContent;
            
            if (!titleEl.getAttribute('data-original')) {
                titleEl.setAttribute('data-original', originalText);
            }

            if (title.includes(query)) {
                card.style.display = 'flex';
                if (query !== '') {
                    const regex = new RegExp(`(${query})`, 'gi');
                    titleEl.innerHTML = originalText.replace(regex, '<mark>$1</mark>');
                } else {
                    titleEl.textContent = originalText;
                }
            } else {
                card.style.display = 'none';
            }
        });

        // Hide headers if no children are visible
        headers.forEach(header => {
            let hasVisible = false;
            let next = header.nextElementSibling;
            while (next && !next.classList.contains('letter-header')) {
                if (next.classList.contains('landmark-card') && next.style.display !== 'none') {
                    hasVisible = true;
                    break;
                }
                next = next.nextElementSibling;
            }
            header.style.display = hasVisible ? 'flex' : 'none';
        });

        // Toggle alphabet nav based on visibility
        const letters = new Set();
        headers.forEach(h => {
            if(h.style.display !== 'none') {
                letters.add(h.getAttribute('data-letter'));
            }
        });
        
        document.querySelectorAll('.letter-btn').forEach(btn => {
            if(letters.has(btn.textContent)) {
                btn.style.opacity = '1';
                btn.style.pointerEvents = 'auto';
            } else {
                btn.style.opacity = '0.3';
                btn.style.pointerEvents = 'none';
            }
        });
    });
});
</script>
