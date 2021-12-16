<?php

namespace SDTech\Observers\Disease;

use SplSubject;

class OnboardNotification implements \SplObserver
{

    /**
     * @inheritDoc
     */
    public function update(SplSubject $subject)
    {
        print "OnboardNotification: We are glad that you added your locality to our system of monitoring sick people!\n";
    }
}