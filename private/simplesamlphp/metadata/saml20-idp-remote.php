<?php

/**
 * SAML 2.0 remote IdP metadata for SimpleSAMLphp.
 *
 * Remember to remove the IdPs you don't use from this file.
 *
 * See: https://simplesamlphp.org/docs/stable/simplesamlphp-reference-idp-remote
 */
$metadata['https://test-adfs.slac.stanford.edu/adfs/services/trust'] = [
  'entityid' => 'https://test-adfs.slac.stanford.edu/adfs/services/trust',
  'description' => [
    'en-US' => 'UAT - SLAC National Accelerator Laboratory',
  ],
  'OrganizationName' => [
    'en-US' => 'UAT - SLAC National Accelerator Laboratory',
  ],
  'name' => [
    'en-US' => 'UAT - SLAC National Accelerator Laboratory',
  ],
  'OrganizationDisplayName' => [
    'en-US' => 'UAT - SLAC National Accelerator Laboratory',
  ],
  'url' => [
    'en-US' => 'https://www.slac.stanford.edu/',
  ],
  'OrganizationURL' => [
    'en-US' => 'https://www.slac.stanford.edu/',
  ],
  'contacts' => [
    [
      'contactType' => 'support',
      'givenName' => 'SLAC IT Help Desk',
      'emailAddress' => [
        'ithelp@slac.stanford.edu',
      ],
      'telephoneNumber' => [
        '650-926-4357',
      ],
    ],
  ],
  'metadata-set' => 'saml20-idp-remote',
  'SingleSignOnService' => [
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => 'https://test-adfs.slac.stanford.edu/adfs/ls/',
    ],
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
      'Location' => 'https://test-adfs.slac.stanford.edu/adfs/ls/',
    ],
  ],
  'SingleLogoutService' => [
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => 'https://test-adfs.slac.stanford.edu/adfs/ls/',
    ],
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
      'Location' => 'https://test-adfs.slac.stanford.edu/adfs/ls/',
    ],
  ],
  'ArtifactResolutionService' => [],
  'NameIDFormats' => [
    'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
    'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',
    'urn:oasis:names:tc:SAML:2.0:nameid-format:transient',
  ],
  'keys' => [
    [
      'encryption' => true,
      'signing' => false,
      'type' => 'X509Certificate',
      'X509Certificate' => 'MIIE+DCCAuCgAwIBAgIQaWmCbi3oQLVAHO/2qvX99DANBgkqhkiG9w0BAQsFADA4MTYwNAYDVQQDEy1BREZTIEVuY3J5cHRpb24gLSB0ZXN0LWFkZnMuc2xhYy5zdGFuZm9yZC5lZHUwHhcNMjExMjAzMDcxMDU2WhcNMjIxMjAzMDcxMDU2WjA4MTYwNAYDVQQDEy1BREZTIEVuY3J5cHRpb24gLSB0ZXN0LWFkZnMuc2xhYy5zdGFuZm9yZC5lZHUwggIiMA0GCSqGSIb3DQEBAQUAA4ICDwAwggIKAoICAQClv/QiIzsvCU1QKxMxmEkj0Vh3m+NNh7mb5mRtBPKOeXTclCGuWpLfFB1UAsScRW8X/RBdOaRiV2kq6Nbmsy1tz5U0eEL7ZDeveib09RlXPtaPmka23Xc4rbMNLr2HIWNZQ0/vctjfGPpq/HoNeiNXI+Wm69tNlmhu3UDXd/JpG7ZlmYCARRJ8lQ/UumV5tFwgTDnWmpHRhHhLhTXHNBENNfNqO5keNJKlzXVruKIfPxqInZAx5KkChyPeg8bv0LUMkRjwI7F6BN5HZylMo1Crl7n3z4KJosl4dLB3BKdCri48SVlyr/pcWHGuCkMarJnmRCyCBv7gMCYrgM0nDUPOzxe9MMraR6/uYAuW/dn+bUhfdH8Z1ioJIbZr5myFav2jlc71ajjOB2YywwnlIgdCdfRHdeDeuy1tdVjxJnl+CHF9CnFyDUPlFBuKuHHGAHgYbmKf7YLODV6YrpZdGHLdPvQXZaiYE4b7AoSa/DRIdADruynm2rQNefeX1Y1BSgeUaK/7zjAK8kxuNvb/G+G75mwkKXcy7AcB3o0jXixZKA3RMZs/eMwtjw4SUJeQ1tvZ3igN+zv225trFVykf1ter0Vw4hvSk3BCjZbUAcPT+r6D1oAv9F/iMZM33NQdW2/Utrc4e+8BOrHXeVD7EyRDRF0TGQAa9tZTgkMAUxhpHQIDAQABMA0GCSqGSIb3DQEBCwUAA4ICAQAbvZV6G+8E+3dfnXC8a4IMAU5dz7M0ZjxhqPOP8Pcun4hMXIugBn2qTQ6zN1+LLuYonjOKOgFbcxeHEwneHdX8AxZ5tAQhDIRMRdxR/UbSkZn1b2SkrgrpP1IQbFjfD9fzOYVg7k94daUWnm+bKUm/kHqqdpxiqCnGcBg48Yhu0uMiWVW4kkjQHVOCkNmxoHS2SCg2OVfNu0pRtejxt5GjlBF8/thfgD1RlFpZZYQeY1EkHXbJZVyZq7hjXfGjLX4cdqersx6S2bc6gxvG6T1jvviLYMTHCfk4WxontfUscDQNAgnsKiI716xPl3N1hX1lW/8MaAs3hMdHNaXsTijyHlXzywYJhPVOBpeFAFa/+Kpj9qFEUeNQYlfJXdkRCdSgaX3qcyWz+RdvKWD5hmxAVaFYCxCOYrfUZwJ91csl1ECAwPd0DZYXU+f6lHCQS5K0i3JPrFicHcPV8b9hsOG5X2bW1AeGi7W0dCZtBsK3gD9YNiBWcipDPFPhhUzjAxtx5f5SbDSbaiflZNPaFFNZ/yaJlBVi9SEYKwdPpbOD0rgmwEq3h27ozMXrTYI/PcwKiQBtG+Gq8NDhEAw5Xk/x0I6BBfD0+IX60agGq4NS5zImysQC5/Qe2h1hJGaxv62t9pk5S2pQ0UCRohCoGmbInoYhEWp477AJReHW9/MKag==',
    ],
    [
      'encryption' => false,
      'signing' => true,
      'type' => 'X509Certificate',
      'X509Certificate' => 'MIIE8jCCAtqgAwIBAgIQNIfTZfu1r4dG3f23L2Xl8zANBgkqhkiG9w0BAQsFADA1MTMwMQYDVQQDEypBREZTIFNpZ25pbmcgLSB0ZXN0LWFkZnMuc2xhYy5zdGFuZm9yZC5lZHUwHhcNMjExMjAzMDcxMDU1WhcNMjIxMjAzMDcxMDU1WjA1MTMwMQYDVQQDEypBREZTIFNpZ25pbmcgLSB0ZXN0LWFkZnMuc2xhYy5zdGFuZm9yZC5lZHUwggIiMA0GCSqGSIb3DQEBAQUAA4ICDwAwggIKAoICAQDQRTMJ3PuNEERBmIB8H12SmHEPnf1QPBf8bqzhoGBbmZGQ8+Et4vs5A/aYcgDYKQFoz7own20Ed3IBU5VIIeWchtLHgn3SYN9bPCngXe3hZm7kLFxlccILBVmOkolOgLVbYTzPHUjOBnGgh2tPzDUxriHCyeRtqvkLLYilJbh5Vf/AoGQAc5vOUVWEg/f335GjZarSfD+yNuogQOZheYYVW12+JaQuGlioIuhfK6z7PNV5LxO2Htq46XsXPgPthOwLYlQsAOE5zAPUqVFPVb02yCsMyRX0q4B+xgaNZLrkFmPUhUBe12j8AwcBZbgRK3EkwVzqFJpSChnSPWyxgW60xRhslLKoBJi0ksPO1HTUl2dFRiEZgFcZZwO+pv/oHeHgb/wXBQYypb2WofrLeIMvqbyzfnNZ/ihhJ0dl60Qo1T04ux+pESvzXf68rriZTKHXYxb6vBEwSiBEhOg+ifPNS02aPmMh27FL5UksvYzBGaDip+V4D8lyXwGhAUK6SzNxKIa7RuW3jMYYUm8MQ5vq2czn+79Lyevh8Rc8wwb55hLnm2B33vZA9kdSpCfoX7+DEWdrQzgRXCdEWEis/9vm0c99co5DEQoE+g1NKXhLbCI5IrchJM/yhcwY+Ur8jDlYBD/ikFQS13Kiu+4rI8rlBlYFJyjwY46usLhLFkHuKQIDAQABMA0GCSqGSIb3DQEBCwUAA4ICAQB8+68/bR/aapYvt62pnO2Zp+/ojREkQKWkabig8sgS+pWDx5251LCJkIePcXXfuTZoMtBBtcOkO2s951ezETvLNlMecGkDkZi84Bcdorx/HbDvGYPlb+kQIvUtZIXwz5qTdTRMv7Z9YkTsKr56TyjanBJLecwIb+8ptxN3BEGvmU9LtqxHU/FXt0fiFNrFcwiDYT8ETyO3zfWxyBAH7CD00yxmL5NEflskuOZ8ZV8w6O3RTqH8EG+lRoLIC8FwMkDo8wUT6M3GtuV8MN4Wl1vs6LNMxwvG91Yv1m51w1UP4Cfv+V9F11AuHBfiFBGQ92OeyWt7Hfz4Ze00MTWR6D2uzmrlGqvWhX8yHwQXQf15fcqBOm+vPhNNfcfg/IuB+rq+Fcj9V40QEFzTGFk1ah6xtt0E6ESOOAwu4dHWDH5ZdOMqSRgKF6N1J9AEhaNKTA1v/czIQydki4gtIoabAoLqa2roF4Og23zMK9JWfWWi8jJCzSCT3gbEwZVXJzLH+y5+GIoKRGHTqxxSY8IfohB44Ht1cinojzy9rTrW6ZTXaflUNhNNmiUpBUgmyKzWAvDdshhOkpdzN+RMQt4qRTcjUE/PVevVZ2OSAwhuVi48Q6A5rnJOskbVG7mJZI+skkmcHIhsvVp+8krD2JQk2MVemFWV9/gyQxTcvAJgoOVnYQ==',
    ],
  ],
];
