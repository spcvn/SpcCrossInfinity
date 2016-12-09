<div id="contents" class="top">
    <!--▼▼▼main▼▼▼-->
    <div class="main top">
        <!--▼▼▼article▼▼▼-->
        <article>
            <section>
            <form id="form_login" method="POST" action="<?php echo base_url('login'); ?>">
                <img src="<?php echo base_url('assets/frontend'); ?>/img/cross_logo_top.png"
                 srcset="<?php echo base_url('assets/frontend'); ?>/img/cross_logo_top.png 1x, <?php echo base_url('assets/frontend'); ?>/img/cross_logo_top@2x.png 2x" class="top_logo" alt="">
                 <table class="login">
                 <tbody>
                     <tr>
                        <th><span class="item">ID</span></th>
                        <td><span class="entry"><input class="<?php echo (empty(form_error('id'))) ? '' : 'error'; ?>" type="text" name="id" value="<?php echo set_value('id'); ?>" placeholder="※3桁の英字と9桁の数字" autofocus maxlength="12"></span>
                            <?php echo '<label class="error">'.form_error('id').'</label>' ?>
                        </td>
                     </tr>
                     <tr>
                        <th><span class="item">PASS</span></th>
                        <td><span class="entry"><input class="<?php echo empty(form_error('password')) ? '' : 'error'; ?>" type="password" name="password" value="" placeholder="※半角英数字記号含む" maxlength="50"></span>
                            <?php echo '<label class="error">'.form_error('password').'</label>' ?>
                        </td>
                     </tr>
                    <?php
                        if(!empty($this->session->flashdata('error')))
                        {
                            echo '<tr class="tr-error">
                                    <th>&nbsp;</th>
                                    <td><p class="error">'.$this->session->flashdata('error').'</p></td>
                                 </tr>';
                        }
                    ?>
                     <tr>
                        <th>&nbsp;</th>
                        <td class="center">
                        <input type="checkbox" id="checkbox" name="remember" value="1" /><label class="check" for="checkbox">ログイン状態を保存する</label>
                        </td>
                     </tr>
                     <tr>
                        <th>&nbsp;</th>
                        <td class="center">
                        <button type="submit" class="login">ログイン</button>
                        </td>
                     </tr>
                     <tr>
                        <th>&nbsp;</th>
                        <td><a href="<?php echo base_url('reset-password'); ?>"><p class="link">パスワードをお忘れの方</p></a></td>
                     </tr>
                 </tbody>
                 </table>
                 
                 <div class="registration">
                    <a href="<?php echo base_url('user/registration'); ?>"><div class="btn">新規会員登録</div></a>
                    <a href="<?php echo base_url('company/registration'); ?>"><div class="btn">企業様新規会員登録</div></a>
                    <!-- <a class="popup-modal" href="#test-modal"><div class="btn">企業様新規会員登録</div></a> -->
                    
                 </div>
            </form>  
            </section>
            <section class="sum_total">
                <ul>
                    <li class="companies">
                        <p>現在の登録企業数</p>
                        <p class="number"><?php echo $count_companies; ?></p>
                    </li>
                    <li class="introducer">
                        <p>現在の会員数</p>
                        <p class="number"><?php echo $count_users; ?></p>
                    </li>
                </ul>
            </section>
        </article>
        <!--▲▲▲article▲▲▲-->
    </div>
    <!--▲▲▲main▲▲▲-->
</div>
<!--▲▲▲contents▲▲▲-->
