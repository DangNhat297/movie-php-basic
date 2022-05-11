<?php 
    session_start();
    if(!isset($_SESSION['username']) && !isset($_SESSION['flagLogin'])){
        header('Location: VIP/login.php');
    }
    include 'incfiles/functions.php';
    include 'config.php';
    include 'incfiles/head.php';
?>
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <i class="fas fa-cart-arrow-down fa-5x"></i>
                                </div>
                                <div class="col-8 text-right">
                                    <span> Tổng số phim </span>
                                    <h2 class="font-bold"><? echo countRecord("film") ?></h2>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fas fa-clipboard-check fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Số tập </span>
                                <h2 class="font-bold"><? echo countRecord("episode") ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 yellow-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fas fa-users-cog fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Quản trị </span>
                                <h2 class="font-bold"><? echo countRecord("users") ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 yellow-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fas fa-users-cog fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Bình luận </span>
                                <h2 class="font-bold"><? echo countRecord("comment") ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
    $sql = "SELECT * FROM film ORDER BY fview DESC LIMIT 5";
    $query = $conn->prepare($sql);
    $query->execute();
    $films = $query->fetchAll(); 
?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>TOP 5 Phim Lượt Xem Cao Nhất</h5>
                        </div>
                        <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover manage-film" >
                                <thead>
                                    <tr>
                                        <th>Tên phim</th>
                                        <th>Loại phim</th>
                                        <th>Số tập</th>
                                        <th>Lượt xem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($films as $film): ?>
                                    <?php 
                                        $sql = "SELECT count(*) as sotap FROM episode,film WHERE episode.movie = film.id AND film.id = $film[0]";
                                        $query = $conn->prepare($sql);
                                        $query->execute();
                                        $numEpisode = $query->fetch()['sotap'];
                                    ?>
                                    <tr>
                                        <td><?=$film['fname']?></td>
                                        <td><?=($film['ftype'] == 'phimle') ? 'Movie / OVA' : 'Phim bộ' ?></td>
                                        <td><?echo $numEpisode.'/'.$film['fnum_episode']?></td>
                                        <td><?=$film['fview']?></td>
                                    </tr>
                                <?php endforeach ?>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    include 'incfiles/foot.php';
?>

</body>
</html>
