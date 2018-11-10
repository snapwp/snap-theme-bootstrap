<footer class="footer bg-dark text-white py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                Footer
            </div>
        </div>
    </div>
</footer>

<?php if ($this->extends_layout() === false) : ?>
    <?php wp_footer(); ?>
    </body>
    </html>
<?php endif;
