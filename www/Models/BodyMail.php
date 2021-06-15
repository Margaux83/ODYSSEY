<?php
namespace App\Models;

class BodyMail {

    public function buildBodyMailConfirmation($email, $token) {
        return "<body style=\"background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;\">
    <!-- HIDDEN PREHEADER TEXT -->
    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
        <!-- LOGO -->
        <tr>
            <td bgcolor=\"#99E1E5\" align=\"center\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">
                    <tr>
                        <td align=\"center\" valign=\"top\" style=\"padding: 40px 10px 40px 10px;\"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor=\"#99E1E5\" align=\"center\" style=\"padding: 0px 10px 0px 10px;\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"center\" valign=\"top\" style=\"padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;\">
                            <h1 style=\"font-size: 48px; font-weight: 400; margin: 2;\">Bienvenue!</h1> <img src=\" https://tracknema.fr/logo/odyssey_logo_withoutText.png\" width=\"125\" height=\"120\" style=\"display: block; border: 0px;\" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor=\"#f4f4f4\" align=\"center\" style=\"padding: 0px 10px 0px 10px;\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">
                            <p style=\"margin: 0;\">Nous sommes heureux de vous compter parmi nous. Commencez par valider votre compte en cliquant sur le bouton ci-dessous.</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\">
                            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                <tr>
                                    <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 30px 60px 30px;\">
                                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                            <tr>
                                                <td align=\"center\" style=\"border-radius: 3px;\" bgcolor=\"#99E1E5\"><a href=\"http://localhost:8080/verification?email={$email}&token={$token}\" target=\"_blank\" style=\"font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #99E1E5; display: inline-block;\">Confirmer le compte</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> <!-- COPY -->
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">
                            <p style=\"margin: 0;\">Si ça ne fonctionne pas, veuillez cliquer sur le lien ci-dessous :</p>
                        </td>
                    </tr> <!-- COPY -->
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 20px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">
                            <p style=\"margin: 0;\"><a href=\"http://localhost:8080/verification?email={$email}&token={$token}\" target=\"_blank\" style=\"color: #99E1E5;\">http://localhost:8080/verification?email={$email}&token={$token}</a></p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">
                            <p style=\"margin: 0;\">Si vous avez une question, n'hésitez pas à nous contacter en répondant à cette adresse mail.</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">
                            <p style=\"margin: 0;\">Cordialement,<br>Odyssey Team</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>";
    }

    public function buildBodyForgotPassword($email, $token) {
        return "<body style=\"background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;\">
    <!-- HIDDEN PREHEADER TEXT -->
    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
        <!-- LOGO -->
        <tr>
            <td bgcolor=\"#99E1E5\" align=\"center\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">
                    <tr>
                        <td align=\"center\" valign=\"top\" style=\"padding: 40px 10px 40px 10px;\"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor=\"#99E1E5\" align=\"center\" style=\"padding: 0px 10px 0px 10px;\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"center\" valign=\"top\" style=\"padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;\">
                            <h1 style=\"font-size: 48px; font-weight: 400; margin: 2;\">Bienvenue!</h1> <img src=\" https://tracknema.fr/logo/odyssey_logo_withoutText.png\" width=\"125\" height=\"120\" style=\"display: block; border: 0px;\" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor=\"#f4f4f4\" align=\"center\" style=\"padding: 0px 10px 0px 10px;\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">
                            <p style=\"margin: 0;\">Votre token à saisir est le suivant : {$token}</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\">
                            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                <tr>
                                    <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 30px 60px 30px;\">
                                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                            <tr>
                                                <td align=\"center\" style=\"border-radius: 3px;\" bgcolor=\"#99E1E5\"><a href=\"http://localhost:8080/forgotpasswordconfirm?email={$email}&token={$token}\" target=\"_blank\" style=\"font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #99E1E5; display: inline-block;\">Changer de mot de passe</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> <!-- COPY -->
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">
                            <p style=\"margin: 0;\">Si vous avez une question, n'hésitez pas à nous contacter en répondant à cette adresse mail.</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">
                            <p style=\"margin: 0;\">Cordialement,<br>Odyssey Team</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>";
    }

    public function buildBodyMailConfirmationBack($email, $token) {
        return "<body style=\"background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;\">
    <!-- HIDDEN PREHEADER TEXT -->
    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
        <!-- LOGO -->
        <tr>
            <td bgcolor=\"#99E1E5\" align=\"center\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">
                    <tr>
                        <td align=\"center\" valign=\"top\" style=\"padding: 40px 10px 40px 10px;\"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor=\"#99E1E5\" align=\"center\" style=\"padding: 0px 10px 0px 10px;\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"center\" valign=\"top\" style=\"padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;\">
                            <h1 style=\"font-size: 48px; font-weight: 400; margin: 2;\">Bienvenue!</h1> <img src=\" https://tracknema.fr/logo/odyssey_logo_withoutText.png\" width=\"125\" height=\"120\" style=\"display: block; border: 0px;\" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor=\"#f4f4f4\" align=\"center\" style=\"padding: 0px 10px 0px 10px;\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\">
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">
                            <p style=\"margin: 0;\">Nous sommes heureux de vous compter parmi nous. Commencez par valider votre compte en créant un nouveau mot de passe.</p>
                            <p style=\"margin: 0;\"> Votre token à saisir est le suivant : {$token}</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\">
                            <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                <tr>
                                    <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 30px 60px 30px;\">
                                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                            <tr>
                                                <td align=\"center\" style=\"border-radius: 3px;\" bgcolor=\"#99E1E5\"><a href=\"http://localhost:8080/verification?email={$email}&token={$token}\" target=\"_blank\" style=\"font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #99E1E5; display: inline-block;\">Confirmer le compte</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> <!-- COPY -->
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 0px 30px 0px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">
                            <p style=\"margin: 0;\">Si ça ne fonctionne pas, veuillez cliquer sur le lien ci-dessous :</p>
                        </td>
                    </tr> <!-- COPY -->
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 20px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">
                            <p style=\"margin: 0;\"><a href=\"http://localhost:8080/verification?email={$email}&token={$token}\" target=\"_blank\" style=\"color: #99E1E5;\">http://localhost:8080/verification?email={$email}&token={$token}</a></p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">
                            <p style=\"margin: 0;\">Si vous avez une question, n'hésitez pas à nous contacter en répondant à cette adresse mail.</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor=\"#ffffff\" align=\"left\" style=\"padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">
                            <p style=\"margin: 0;\">Cordialement,<br>Odyssey Team</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>";
    }

}
