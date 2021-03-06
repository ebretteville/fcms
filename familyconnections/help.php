<?php
/**
 * Help
 * 
 * PHP versions 4 and 5
 * 
 * @category  FCMS
 * @package   FamilyConnections
 * @author    Ryan Haudenschilt <r.haudenschilt@gmail.com> 
 * @copyright 2007 Haudenschilt LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GPLv2
 * @link      http://www.familycms.com/wiki/
 */
session_start();

define('URL_PREFIX', '');
define('GALLERY_PREFIX', 'gallery/');

require 'fcms.php';

init();

$page  = new Page($fcmsError, $fcmsDatabase, $fcmsUser);

exit();

class Page
{
    private $fcmsError;
    private $fcmsDatabase;
    private $fcmsUser;

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct ($fcmsError, $fcmsDatabase, $fcmsUser)
    {
        $this->fcmsError         = $fcmsError;
        $this->fcmsDatabase      = $fcmsDatabase;
        $this->fcmsUser          = $fcmsUser;

        $this->control();
    }

    /**
     * control 
     * 
     * The controlling structure for this script.
     * 
     * @return void
     */
    function control ()
    {
        if (isset($_GET['topic']))
        {
            $topic = $_GET['topic'];

            if ($topic == 'photo')
            {
                $this->displayPhotoGallery();
            }
            elseif ($topic == 'video')
            {
                $this->displayVideoGallery();
            }
            elseif ($topic == 'settings')
            {
                $this->displaySettings();
            }
            elseif ($topic == 'address')
            {
                $this->displayAddressBook();
            }
            elseif ($topic == 'admin')
            {
                $this->displayAdministration();
            }
            else
            {
                $this->displayHome();
            }
        }
        else
        {
            $this->displayHome();
        }
    }

    /**
     * displayHeader 
     * 
     * @return void
     */
    function displayHeader ()
    {
        $params = array(
            'currentUserId' => $this->fcmsUser->id,
            'sitename'      => getSiteName(),
            'nav-link'      => getNavLinks(),
            'pagetitle'     => T_('Help'),
            'pageId'        => 'help',
            'path'          => URL_PREFIX,
            'displayname'   => getUserDisplayName($this->fcmsUser->id),
            'version'       => getCurrentVersion(),
        );

        displayPageHeader($params);

        loadTemplate('help', 'navigation');
    }

    /**
     * displayFooter 
     * 
     * @return void
     */
    function displayFooter ()
    {
        $params = array(
            'path'    => URL_PREFIX,
            'version' => getCurrentVersion(),
            'year'    => date('Y')
        );

        loadTemplate('global', 'footer', $params);
    }

    /**
     * displayHome 
     * 
     * @return void
     */
    function displayHome ()
    {
        $this->displayHeader();
        loadTemplate('help', 'home');
        $this->displayFooter();
    }

    /**
     * displayPhotoGallery 
     * 
     * @return void
     */
    function displayPhotoGallery ()
    {
        $this->displayHeader();
        loadTemplate('help', 'photo-gallery');
        $this->displayFooter();
    }

    /**
     * displayVideoGallery 
     * 
     * @return void
     */
    function displayVideoGallery ()
    {
        $this->displayHeader();
        loadTemplate('help', 'video-gallery');
        $this->displayFooter();
    }

    /**
     * displaySettings 
     * 
     * @return void
     */
    function displaySettings ()
    {
        $this->displayHeader();
        loadTemplate('help', 'settings');
        $this->displayFooter();
    }

    /**
     * displayAddressBook 
     * 
     * @return void
     */
    function displayAddressBook ()
    {
        $this->displayHeader();
        loadTemplate('help', 'address-book');
        $this->displayFooter();
    }

    /**
     * displayAdministration 
     * 
     * @return void
     */
    function displayAdministration ()
    {
        $this->displayHeader();
        loadTemplate('help', 'administration');
        $this->displayFooter();
    }
}
