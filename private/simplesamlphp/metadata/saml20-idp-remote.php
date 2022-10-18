<?php

/**
 * SAML 2.0 remote IdP metadata for SimpleSAMLphp.
 *
 * Remember to remove the IdPs you don't use from this file.
 *
 * See: https://simplesamlphp.org/docs/stable/simplesamlphp-reference-idp-remote
 */
$metadata['https://test-adfs.slac.stanford.edu'] = [
  'contacts' => [
    [
      'contactType' => 'technical',
      'givenName' => 'Jimmy',
      'surName' => 'Pham',
      'emailAddress' => [
        'jpham@slac.stanford.edu',
      ],
    ],
  ],
  'metadata-set' => 'saml20-idp-remote',
  'SingleLogoutService' => [
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => 'https://adfs.slac.stanford.edu/adfs/ls/?wa=wsignout1.0',
    ],
  ],
  'keys' => [
    [
      'encryption' => false,
      'signing' => true,
      'type' => 'X509Certificate',
      'X509Certificate' => 'MIIEeDCCAuACCQDzrxldKg1+ZjANBgkqhkiG9w0BAQsFADB+MQswCQYDVQQGEwJVUzETMBEGA1UECAwKQ2FsaWZvcm5pYTERMA8GA1UEBwwIU3RhbmZvcmQxHDAaBgNVBAoME1N0YW5mb3JkIFVuaXZlcnNpdHkxDTALBgNVBAsMBFNMQUMxGjAYBgNVBAMMEXNsYWMuc3RhbmZvcmQuZWR1MB4XDTIxMDYyOTIxNTI0OFoXDTMxMDYyOTIxNTI0OFowfjELMAkGA1UEBhMCVVMxEzARBgNVBAgMCkNhbGlmb3JuaWExETAPBgNVBAcMCFN0YW5mb3JkMRwwGgYDVQQKDBNTdGFuZm9yZCBVbml2ZXJzaXR5MQ0wCwYDVQQLDARTTEFDMRowGAYDVQQDDBFzbGFjLnN0YW5mb3JkLmVkdTCCAaIwDQYJKoZIhvcNAQEBBQADggGPADCCAYoCggGBALJNY9c/xZ6zHoT9QF9AWtTmW99/rjiQtfh9jD0Dtn0fXr+0ret59pcGIGpLZ4jP6AtG4w9aYUzOW2LJq7QeikWDC8IuuV/7YgVXpPd02pdNUr9NzO7b8X8uXFmmt8/IpHfYQ8CX0ytFa+CArmnh4Rdl4n+jfCuO6ny8KtEnRzXAoonGJW/t05w/j3QCUjAFk0CzNnkKGkkA2aAqnPIK3josr0rRIP/8OGxmek+cj04Lq8ktq8iSR55FRamfWk6Qd/QZ6bDIoXesDd6MTEkuxWQDU/glzN+7wq2ihwAAc8151T9HH12s3qS7mxQMGrARoEhg5GvfBbKAtLHX42KeNeg9puOtVpfpMtLRX4drzhghWKKKRBj0Qr9hYId+P2d+bJAzzFa8zKjsfdBpakxWmiATugyLDtAS0YSHk1M2+I5mcFoc9I9KJQ2tYVEHEvwNBA0cbrFfO2HDXk8VKSq+M70G9lGJDfp+bQedtYaBTcoILrXixCtAxkQNlzQWTK8WqwIDAQABMA0GCSqGSIb3DQEBCwUAA4IBgQAuMLsh8a7Ejz1yfnzqtjCHs0mJIYCnKXjNXN2KhVDftt0w+R1MJcw2jSrSDFgM4hYjMBvrzzds6d8HM6JW6oW/JLLlfiAzi1iHxKiAe/7cUulbgrO7T2ST+fTTeMbshBUmEKOB5yO2e4ZuQekqwskc3P4k/s4UJhmCeigxGGNbYOrLmwDgdD8RJ7svJk5UCbcrMspmYNNwpF3fph8YPwU9YTNVhmMikA6HLzdKbjlySAmDzs/uOnOKx5xp4sbQ7bqKxUpXi6JdT+2SmVMcOnsaJHKP062txCaBOH3jDwKn3u0bhhfSnotFVzPyFF3m5/d4jySe8uxIIsrCJ3bqLghcmOF2jK1t2RBJfJcnsZeO7pplyIPx6AQhrY/D7bLvkjni++aidenAGDBhotnh6teJwbaKT1ba/PUrs6/3gcNgCkX3O/oWVcKca6xXzojtIEkDz7RRsWCiTgvM3HZYP+CQ9kL2tjeVYW4uJoUC1ArHuaptwImVpRmklOSz2sRGqRI=',
    ],
    [
      'encryption' => true,
      'signing' => false,
      'type' => 'X509Certificate',
      'X509Certificate' => 'MIIEeDCCAuACCQDzrxldKg1+ZjANBgkqhkiG9w0BAQsFADB+MQswCQYDVQQGEwJVUzETMBEGA1UECAwKQ2FsaWZvcm5pYTERMA8GA1UEBwwIU3RhbmZvcmQxHDAaBgNVBAoME1N0YW5mb3JkIFVuaXZlcnNpdHkxDTALBgNVBAsMBFNMQUMxGjAYBgNVBAMMEXNsYWMuc3RhbmZvcmQuZWR1MB4XDTIxMDYyOTIxNTI0OFoXDTMxMDYyOTIxNTI0OFowfjELMAkGA1UEBhMCVVMxEzARBgNVBAgMCkNhbGlmb3JuaWExETAPBgNVBAcMCFN0YW5mb3JkMRwwGgYDVQQKDBNTdGFuZm9yZCBVbml2ZXJzaXR5MQ0wCwYDVQQLDARTTEFDMRowGAYDVQQDDBFzbGFjLnN0YW5mb3JkLmVkdTCCAaIwDQYJKoZIhvcNAQEBBQADggGPADCCAYoCggGBALJNY9c/xZ6zHoT9QF9AWtTmW99/rjiQtfh9jD0Dtn0fXr+0ret59pcGIGpLZ4jP6AtG4w9aYUzOW2LJq7QeikWDC8IuuV/7YgVXpPd02pdNUr9NzO7b8X8uXFmmt8/IpHfYQ8CX0ytFa+CArmnh4Rdl4n+jfCuO6ny8KtEnRzXAoonGJW/t05w/j3QCUjAFk0CzNnkKGkkA2aAqnPIK3josr0rRIP/8OGxmek+cj04Lq8ktq8iSR55FRamfWk6Qd/QZ6bDIoXesDd6MTEkuxWQDU/glzN+7wq2ihwAAc8151T9HH12s3qS7mxQMGrARoEhg5GvfBbKAtLHX42KeNeg9puOtVpfpMtLRX4drzhghWKKKRBj0Qr9hYId+P2d+bJAzzFa8zKjsfdBpakxWmiATugyLDtAS0YSHk1M2+I5mcFoc9I9KJQ2tYVEHEvwNBA0cbrFfO2HDXk8VKSq+M70G9lGJDfp+bQedtYaBTcoILrXixCtAxkQNlzQWTK8WqwIDAQABMA0GCSqGSIb3DQEBCwUAA4IBgQAuMLsh8a7Ejz1yfnzqtjCHs0mJIYCnKXjNXN2KhVDftt0w+R1MJcw2jSrSDFgM4hYjMBvrzzds6d8HM6JW6oW/JLLlfiAzi1iHxKiAe/7cUulbgrO7T2ST+fTTeMbshBUmEKOB5yO2e4ZuQekqwskc3P4k/s4UJhmCeigxGGNbYOrLmwDgdD8RJ7svJk5UCbcrMspmYNNwpF3fph8YPwU9YTNVhmMikA6HLzdKbjlySAmDzs/uOnOKx5xp4sbQ7bqKxUpXi6JdT+2SmVMcOnsaJHKP062txCaBOH3jDwKn3u0bhhfSnotFVzPyFF3m5/d4jySe8uxIIsrCJ3bqLghcmOF2jK1t2RBJfJcnsZeO7pplyIPx6AQhrY/D7bLvkjni++aidenAGDBhotnh6teJwbaKT1ba/PUrs6/3gcNgCkX3O/oWVcKca6xXzojtIEkDz7RRsWCiTgvM3HZYP+CQ9kL2tjeVYW4uJoUC1ArHuaptwImVpRmklOSz2sRGqRI=',
    ],
  ],
  'validate.authnrequest' => true,
];
