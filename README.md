## SuiteCRM 7.10.10

[![Build Status](https://travis-ci.org/salesagility/SuiteCRM.svg?branch=master)](https://travis-ci.org/salesagility/SuiteCRM)
[![codecov](https://codecov.io/gh/salesagility/SuiteCRM/branch/hotfix/graph/badge.svg)](https://codecov.io/gh/salesagility/SuiteCRM/branch/master)


### What's in this repository ###

This is the git repository for the SuiteCRM project, the award-winning, enterprise-class open source CRM.

This repository has been created to allow community members to collaborate and contribute to the project, helping to develop the SuiteCRM ecosystem.

### Contributing to the project ###

#### Security ####

We take Security seriously here at SuiteCRM so if you have discovered a security risk report it by
emailing security@suitecrm.com. This will be delivered to the product team who handle security issues.
Please don't disclose security bugs publicly until they have been handled by the security team.

Your email will be acknowledged within 24 hours during the business week (Mon - Fri), and you’ll receive a more
detailed response to your email within 72 hours during the business week (Mon - Fri) indicating the next steps in
handling your report.

##### Important: Please read before developing code intended for inclusion in the SuiteCRM project. #####

Please read and sign the following [contributor agreement][cont_agrmt]

[cont_agrmt]: https://www.clahub.com/agreements/salesagility/SuiteCRM

The Contributor Agreement only needs to be signed once for all pull requests and contributions. 

Once signed and confirmed, any pull requests will be considered for inclusion in the SuiteCRM project.


### Translations ###
SuiteCRM in your language: [ Download and install language packs from][suitecrm_languages]

[suitecrm_languages]: https://crowdin.com/project/suitecrmtranslations


### Code of Conduct ###

See our [Code of Conduct][code_of_conduct] on our Wiki.

[code_of_conduct]: https://docs.suitecrm.com/community/code-of-conduct/


### Helpful links for the community ###

The following links offer various ways to view, contribute and collaborate to the SuiteCRM project:


+ [SuiteCRM Demo - A fully working SuiteCRM demo available for people to try before downloading the full SuiteCRM package][suitecrm_demo]
+ [SuiteCRM Forums - Forums dedicated to discussions about SuiteCRM with various topics and subjects about SuiteCRM][suitecrm_forums]
+ [SuiteCRM Documentation - A wiki containing relevant documentation to SuiteCRM, constantly being added to][suitecrm_docs]
+ [SuiteCRM Partners - Our partner section where partners of SuiteCRM can be viewed][suitecrm_partners]
+ [SuiteCRM Extensions Directory - An extensions directory where community members can submit extensions built for SuiteCRM][suitecrm_ext]

[suitecrm_demo]: https://suitecrm.com/demo
[suitecrm_forums]: https://suitecrm.com/suitecrm/forum/suite-forum
[suitecrm_docs]: https://docs.suitecrm.com/
[suitecrm_partners]: https://suitecrm.com/about/about-us/partners
[suitecrm_ext]: https://store.suitecrm.com/

### Development Roadmap ###

[ View the Community Roadmap here and get involved][suitecrm_roadmap]

[suitecrm_roadmap]: https://suitecrm.com/roadmap

[More detailed SuiteCRM Community LTS Roadmap][suitecrm_detailed_roadmap]

[suitecrm_detailed_roadmap]: https://suitecrm.com/lts/

### Support & Licensing ###

SuiteCRM is an open source project. As such please do not contact us directly via email or phone for SuiteCRM support. Instead please use our support forum. By using the forum the knowledge is shared with everyone in the community. Our developers answer questions on the forum daily but it also gives the other members of the community the opportunity to contribute. If you would like customisations to specifically fit your SuiteCRM  needs then please use our contact form.

SuiteCRM is published under the AGPLv3 license.

### Custom updations in the SuiteCRM for the Customer verification process.


1. There are a few changes are done in the existing PHP files such as /include/ListView/ListViewData.php
   (The alterations are evident within lines 615 to 633, where the pre-existing code was commented out to prevent potential errors or for future utilization when necessary. In this context, a modified code segment was introduced, occupying lines 634 to 645.)

2. A new database table has been introduced to maintain a comprehensive record of each OTP (One-Time Password) sent to customer IDs, along with the corresponding delivery method. 
   This initiative serves the dual purpose of preserving a history of customer verifications and facilitating user verification through the recorded OTP codes.

3. Two files, namely "verify.php" and "otp_send.php," have been integrated into the existing software and linked within the "ListViewData.php" table, as indicated in line number 1. 
   The "verify.php" file comprises a collection of verification methods retrieved from database tables, which are then presented in a dropdown list. The Customer Service Representative (CSR) has the capability to select the desired verification method requested by the customer. Subsequently, an OTP is dispatched to fulfill the chosen verification process.

4. On the subsequent screen (accessible via "send_top.php"), the Customer Service Representative (CSR) will input the OTP code into the designated fields, as shared by the customer.
   Successful completion of the verification process hinges on a code match between the entered OTP and the corresponding record in our database table. In the event of a mismatch, the verification attempt will be unsuccessful and an accompanying error message will be displayed.

5. 

