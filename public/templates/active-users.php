<ul class="active-player-list">
  <?php foreach($users as $user): ?>
    <li <?php print $user['attributes'] ?>>
      <a href="/members/<?php print $user['slug'] ?>/profile">
        <figure>
          <img src="<?php print $user['avatar'] ?>">
          <figcaption>
            <span><?php print $user['name']?></span>
          </figcaption>
        </figure>
      </a>
    </li>
  <?php endforeach; ?>
</ul>

<?php if($total_players === 1): ?>
  <p>There is <?php print $total_players ?> active player. Quorum is <?php print $quorum ?>.</p>
<?php else: ?>
  <p>There are <?php print $total_players ?> active players. Quorum is <?php print $quorum ?>.</p>
<?php endif; ?>
