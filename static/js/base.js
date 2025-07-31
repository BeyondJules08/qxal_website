        function createFloatingShapes() {
            const colors = ['#FF6B6B', '#4ECDC4', '#45B7D1', '#FFA726', '#66BB6A'];
            const container = document.querySelector('.floating-shapes');
            if (!container) return;
            
            for (let i = 0; i < 6; i++) {
                const shape = document.createElement('div');
                shape.className = 'shape';
                shape.style.background = colors[Math.floor(Math.random() * colors.length)];
                shape.style.width = Math.random() * 100 + 50 + 'px';
                shape.style.height = shape.style.width;
                shape.style.left = Math.random() * 100 + '%';
                shape.style.top = Math.random() * 100 + '%';
                shape.style.animationDelay = Math.random() * 6 + 's';
                shape.style.opacity = '0.1';
                container.appendChild(shape);
            }
        }
        document.addEventListener('DOMContentLoaded', createFloatingShapes);